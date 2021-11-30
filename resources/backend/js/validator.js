/*
** EXAMPLE:
**
** new Validator([
**      {
**          field: $('textarea[name=message]'),     // Required
**          rules: 'required|max:1000',             // Required
**          type: 'string',                         // Optional (default is 'string')
**          selectors: {                            // Optional. Custom selectors for current field
**              parent: '.f_group',
**              parent_error: '.error',
**              span_error: '.error'
**          }
**      },
**  ], {
**      selectors: {                                // Optional. General selectors for all fields
**          parent: '.f_group',
**          parent_error: '.error',
**          span_error: '.error'
**      },
** });
**
*/

function Validator(validation_settings, main_settings)
{
    this.validation_settings = [];
    this._hasInvalidFields = false;
    this._shaddowMode = false;

    main_settings = main_settings || {};

    this.main_settings = {};
    this.events = {
        onAfterValidate: null
    };

    this.main_settings.selectors = $.extend({}, {
        container: 'body', // Main container for Errors From Json
        parent: '.f_group, .form_group, .f_group_v2, .f_group_v3',
        parent_error: '.error',
        span_error: '.error',
        insert_position: 'same_level_last'
    }, main_settings.selectors || {});

    this.main_settings.messages = $.extend({}, {
        required: "Can't be blank",
        confirmation: "Passwords do not match",
        string: {
            between: ':min-:max characters required',
            email: 'Invalid email',
            max: 'Too long (:max characters maximum)',
            min: 'Too short (:min characters minimum)'
        },
        integer: {
            between: 'Select between :min and :max',
            max: 'Too big (maximum is :max)',
            min: 'Too small (minimum is :min)'
        },
        jfiler: {
            required: 'You must load the file'
        },
        checkbox: {
            required: 'Accept our Terms of Use to proceed'
        }
    }, main_settings.messages || {});

    this.appendValidateSettings(validation_settings);
}

Validator.prototype.appendValidateSettings = function(newSettings)
{
    for(var i in newSettings)
    {
        var setting = newSettings[i];
        setting.validator = this;
        setting.rules = this.parseRules(setting.rules);
        setting.selectors = setting.selectors || {};
        setting.messages = setting.messages || {};

        $(setting.field).on('change blur', $.proxy(this.onValidate, setting));
        this.validation_settings.push(setting);
    }
};

Validator.prototype.forceValidate = function(ignore)
{
    if(typeof ignore === 'undefined')
    {
        ignore = [];
    }

    for(var i in this.validation_settings)
    {
        var field = $(this.validation_settings[i].field);

        var rule_selectors = this.findRuleSelector(field);
        var selectors = $.extend({}, this.main_settings.selectors, rule_selectors || {});
        // field = field.filter(':is_closest_visible('+ selectors.parent +')'); // Ignore fields which has invisible parent

        if(ignore.indexOf(field.get(0)) >= 0 || field.length === 0)
            continue;

        // For radio we will validate only checked inputs (or first if it's not any checked found)
        if(field.is('input[type=radio]'))
        {
            field = this.getFirstOrCheckedInRadioGroup(field);
        }

        var callback = this.onValidate.bind(this.validation_settings[i]);
        callback({ currentTarget: field });
    }
};

Validator.prototype.isEverythingValid = function(ignore)
{
    if(this.hasErrors(false))
        return false;

    this._hasInvalidFields = false;
    this._shaddowMode = true;
    try {
        this.forceValidate(ignore);
    } finally {
        this._shaddowMode = false;
    }

    return !this._hasInvalidFields;
};

Validator.prototype.getFirstOrCheckedInRadioGroup = function(radios)
{
    var names = [];
    radios.each(function()
    {
        var name = $(this).attr('name');
        if(names.indexOf(name) < 0)
        {
            names.push(name);
        }
    });

    var result = $();
    $(names).each(function()
    {
        var items = radios.filter('[name='+ this +']');
        var checked = items.filter(':checked');
        result = result.add(checked.length > 0 ? checked : items.filter(':first'));
    });

    return result;
};

Validator.prototype.onValidate = function(event)
{
    if(typeof this.validate_if !== 'undefined' && !this.validate_if(this))
    {
        return;
    }

    var target = $(event.currentTarget);
    var selectors = this.selectors || {};
    var type = this.type || 'string';
    this.validator.removeError(target, selectors);

    for(var i in this.rules)
    {
        var rule = this.rules[i].rule;
        var args = this.rules[i].args;
        var error = false;

        switch (rule)
        {
            case 'required':
                error = this.validator.validateRequired(type, target);
                break;
            case 'between':
                error = this.validator.validateBetween(type, target, parseInt(args[0]), parseInt(args[1]));
                break;
            case 'email':
                error = this.validator.validateEmail(target);
                break;
            case 'min':
                error = this.validator.validateMin(type, target, parseInt(args[0]));
                break;
            case 'max':
                error = this.validator.validateMax(type, target, parseInt(args[0]));
                break;
            case 'confirmation':
                error = this.validator.validateConfirmation(type, target);
                break;
        }

        if(error)
        {
            this.validator._hasInvalidFields = true;
            var message = this.validator.getMessage(this.messages, type, rule, args) || this.validator.getMessage(this.validator.main_settings.messages, type, rule, args);
            this.validator.addError(target, message, selectors);
            break;
        }
    }

    if(!this.validator._shaddowMode && this.validator.events.onAfterValidate)
    {
        this.validator.events.onAfterValidate();
    }
};

Validator.prototype.validateRequired = function(type, target)
{
    switch (type)
    {
        case 'checkbox': return !target.prop('checked');
        case 'select': return (target.val() === '') || (target.val() === '0') || (target.val() === null);
        case 'jfiler': return (target.val() === '') || (target.val() === '[]');
        default: return target.val().trim() === '';
    }
};

Validator.prototype.validateBetween = function(type, target, min, max)
{
    var value = this.getNumberValueByType(type, target);
    return isNaN(value) || value < min || value > max;
};

Validator.prototype.validateEmail = function(target)
{
    if(target.val().trim() === '')
        return false;

    var re = /^[a-z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-z0-9][a-z0-9-]+(?:\.[a-z0-9-]+)*\.[a-z]+$/i;
    return !re.test(target.val().trim());
};

Validator.prototype.validateMin = function(type, target, min)
{
    var value = this.getNumberValueByType(type, target);
    return isNaN(value) || value < min;
};

Validator.prototype.validateMax = function(type, target, max)
{
    var value = this.getNumberValueByType(type, target);
    return isNaN(value) || value > max;
};

Validator.prototype.validateConfirmation = function(type, target)
{
    var mainField = $('[name="' + target.attr('name').replace('_confirmation', '') + '"]:first');
    return (!this.fieldHasErrors(mainField)) && (mainField.val() !== target.val());
};

Validator.prototype.getNumberValueByType = function(type, target)
{
    switch (type)
    {
        case 'integer': return parseInt(target.val());
        case 'float': return parseFloat(target.val());
        default: return target.val().trim().length;
    }
};

Validator.prototype.parseRules = function(rules)
{
    var result = [];
    var arrRules = rules.split('|');
    for(var i in arrRules)
    {
        var ruleAndArgs = arrRules[i].split(':');
        var rule = ruleAndArgs[0];
        var args = [];
        if(ruleAndArgs.length > 1)
        {
            var arrArguments = ruleAndArgs[1].split(',');
            for(var a in arrArguments)
            {
                args.push(arrArguments[a]);
            }
        }

        result.push({ rule: rule, args: args});
    }

    return result;
};

Validator.prototype.findRuleSelector = function(target)
{
    for(var i in this.validation_settings)
    {
        var setting = this.validation_settings[i];
        if($(setting.field).get(0) === target.get(0))
        {
            return setting.selectors;
        }
    }
};

Validator.prototype.addError = function(target, message, rule_selectors)
{
    if(this._shaddowMode)
        return;

    if(typeof rule_selectors === 'undefined')
    {
        rule_selectors = this.findRuleSelector(target);
    }

    var selectors = $.extend({}, this.main_settings.selectors, rule_selectors || {});
    var span = $('<span></span>').addClass(this.selectorToClasses(selectors.span_error)).html(message);
    var parent = target.closest(selectors.parent);

    var position = selectors.insert_position.split(':', 2);
    switch (position[0])
    {
        case 'parent_last': parent.append(span); break;
        case 'lvl_up_next': span.insertAfter(target.parent()); break;
        case 'lvl_up_last': target.parent().parent().append(span); break;
        case 'next': span.insertAfter(target); break;
        case 'selector_append': $(position[1]).append(span); break; // Example: {insert_position: 'selector_append:#subject_title'}
        default: target.parent().append(span); break; // same_level_last
    }

    parent.addClass(this.selectorToClasses(selectors.parent_error));
};

Validator.prototype.removeError = function(target, rule_selectors)
{
    if(this._shaddowMode)
        return;

    var selectors = $.extend({}, this.main_settings.selectors, rule_selectors || {});
    var parent = target.closest(selectors.parent);

    var position = selectors.insert_position.split(':', 2);
    switch (position[0])
    {
        case 'parent_last': parent.find('> span' + selectors.span_error).remove(); break;
        case 'lvl_up_next': target.parent().next('span' + selectors.span_error).remove(); break;
        case 'lvl_up_last': target.parent().parent().find('> span' + selectors.span_error).remove(); break;
        case 'next': target.next('span' + selectors.span_error).remove(); break;
        case 'selector_append': $(position[1]).find('> span' + selectors.span_error).remove(); break;
        default: target.parent().find('> span' + selectors.span_error).remove(); break; // same_level_last
    }

    parent.removeClass(this.selectorToClasses(selectors.parent_error));
}

Validator.prototype.clearErrors = function(except)
{
    if(typeof except === 'undefined')
    {
        except = [];
    }

    for(var i in this.validation_settings)
    {
        var setting = this.validation_settings[i];
        var selectors = $.extend({}, this.main_settings.selectors, setting.selectors || {});
        var field = $(setting.field);

        if(except.indexOf(field.get(0)) < 0)
        {
            this.removeError(field, selectors);
        }
    }

    if(this.events.onAfterValidate)
    {
        this.events.onAfterValidate();
    }
}

Validator.prototype.addErrorsFromJson = function(data, scrollToFirst, extra_offset)
{
    if(typeof extra_offset === 'undefined')
    {
        extra_offset = 10;
    }

    var topOffset = false;
    var errors = data.responseJSON.errors || data.responseJSON;

    for (var key in errors)
    {
        var name = key.replace(/[^\.]+\./, ''); // Delete "client." from "client.name" string
        var input = $(this.main_settings.selectors.container).find("[name=" + name +"]");

        var rule_selectors = this.findRuleSelector(input);
        var selectors = $.extend({}, this.main_settings.selectors, rule_selectors || {});
    //     input = input.filter(':is_closest_visible('+ selectors.parent +')'); // Ignore fields which has invisible parent

        if(input.length === 0)
        {
            continue;
        }
        this.removeError(input);
        this.addError(input, Array.isArray(errors[key]) ? errors[key][0] : errors[key], selectors);

        var offset = input.closest(selectors.parent).offset().top - $('header').outerHeight() - extra_offset;
        if(topOffset === false || offset < topOffset)
        {
            topOffset = offset;
        }
    }

    if(topOffset !== false && scrollToFirst)
    {
        $('html, body').animate({ scrollTop: topOffset }, 500);
    }

    if(this.events.onAfterValidate)
    {
        this.events.onAfterValidate();
    }
}

Validator.prototype.fieldHasErrors = function(target, selectors)
{
    if(typeof selectors === 'undefined')
    {
        selectors = this.findRuleSelector(target);
    }

    selectors = $.extend({}, this.main_settings.selectors, selectors);
    var parent = target.closest(selectors.parent).filter(selectors.parent_error + ':visible');
    return parent.length > 0;
}

Validator.prototype.hasErrors = function(scrollToFirst, extra_offset)
{
    var topOffset = false;
    for(var i in this.validation_settings)
    {
        var setting = this.validation_settings[i];
        var field = $(setting.field);
        if(this.fieldHasErrors(field, setting.selectors))
        {
            if(!scrollToFirst)
            {
                return true;
            }
            if(typeof extra_offset === 'undefined')
            {
                extra_offset = 10;
            }
            var selectors = $.extend({}, this.main_settings.selectors, this.findRuleSelector(field) || {});
            var offset = field.closest(selectors.parent).offset().top - $('header').outerHeight() - extra_offset;
            if(topOffset === false || offset < topOffset)
            {
                topOffset = offset;
            }
        }
    }

    if(topOffset !== false && scrollToFirst)
    {
        $('html, body').animate({ scrollTop: topOffset }, 500);
    }

    return topOffset !== false;
}

Validator.prototype.getMessage = function(messages, type, rule, args)
{
    var message = null;

    if(typeof messages[type] !== 'undefined' && typeof messages[type][rule] !== 'undefined')
    {
        message = messages[type][rule];
    }
    else if(typeof messages[rule] !== 'undefined')
    {
        message = messages[rule];
    }

    if(message !== null)
    {
        switch (rule)
        {
            case 'between':
                message = message.replace(':min', args[0]).replace(':max', args[1]);
                break;
            case 'min':
                message = message.replace(':min', args[0]);
                break;
            case 'max':
                message = message.replace(':max', args[0]);
                break;
        }
    }

    return message;
}

Validator.prototype.selectorToClasses = function(selector)
{
    return selector.replace(/\./g, ' ');
}
