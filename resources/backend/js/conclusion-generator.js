function ConclusionGenerator()
{
    this.container = $('.conclusion_generator');
    this.API_url = 'http://localhost/';
    this.API_key = '53V363XcSVOEsqRtHjxW';

    this.fields = {
        title: this.container.find('input[name=title]'),
        text: this.container.find('textarea[name=text]'),
    };

    this.values = {};

    this.submit = this.container.find('#summarize-button');
    this.count_input = this.container.find('input[name=count_value]');

    this.validator = new Validator([
        {
            field: this.fields.title,
            selectors: {
                span_error: '.error-message',
                parent: '.form-group'
            },
            rules: 'required|between:1,100',
            messages: {
                required: 'You must provide a title that is between 1 and 100 characters.',
                string: {
                    between: 'You must provide a title that is between 1 and 100 characters.'
                }
            }
        },
        {
            field: this.fields.text, rules: 'required|min:1|max:15000',
            selectors: {
                insert_position: 'parent_last',
                span_error: '.error-message',
                parent: '.form-group'
            },
            messages: {
                required: 'You must provide a text that is at least 200 words',
                string: {
                    min: 'You must provide a text that is at least 200 words',
                    max: ':max characters MAX.'
                }
            }
        },
    ]);

    this.InitEvents();
}

ConclusionGenerator.prototype.InitEvents = function()
{
    this.submit.click($.proxy(this.onSubmitConclusionGenerator, this));
    this.count_input.focusin($.proxy(this.onCountInputChange, this));
}

ConclusionGenerator.prototype.onSubmitConclusionGenerator = function(event)
{
    event.preventDefault();
    if (!document.querySelector('body').classList.contains('result-generator')) {
        this.submit.prop('disabled', true);

        var validator = this.validator;

        this.validator.clearErrors();
        this.validator.forceValidate();

        if (validator.hasErrors(true)) {
            this.submit.prop('disabled', false);
            return;
        }

        var data = {
            key: this.API_key,
            title: this.fields.title.val(),
            text: this.fields.text.val(),
            count: this.container.find('input[name=count]:checked').val(),
        };

        var $this = this;
        this.values.origWords = this.fields.text.val().split(' ').length;
        $('.loader').css({'display': 'block', 'opacity': .7});

        $.post(this.API_url + 'api/summarize-text', data, function(data) {
            $('.loader').css({'display': 'none', 'opacity': 0});
            $this.setValues(data);
            $this.submit.prop('disabled', false);
            $this.showResults();
        }).fail(function(data) {
            $('.loader').css({'display': 'none', 'opacity': 0});
            $this.submit.prop('disabled', false);
            validator.addErrorsFromJson(data, true);
        });
    }
}

ConclusionGenerator.prototype.setValues = function(data)
{
    this.values.text = data.text;
}

ConclusionGenerator.prototype.showResults = function()
{
    $('textarea[name=text]').val(this.values.text);
    $('body').addClass('result-generator');
    $('.radio-buttons .text').html('Need better results? <a href="' + $('.conclusion-generator-banner .button').attr('href') + '">Get expert editing help!</a>');
    this.submit.text('Resubmit');
    this.submit.attr('onclick', 'window.location.reload()');

    var origWords = this.values.origWords;
    var sumWords = this.values.text.split(' ').length;
    var percent = (((origWords - sumWords) / origWords) * 100).toFixed(2).split('.');

    this.fields.title.attr('disabled', true);

    this.container.find('.original-words').text(origWords + ' words');
    this.container.find('.summary-words').text(sumWords + ' words');
    this.container.find('.percent').text(percent[0] + '.' + percent[1] + '%');
}

ConclusionGenerator.prototype.onCountInputChange = function()
{
    $('#inlineRadio3').prop('checked', true);
    var $this = this;
    this.count_input.on('keypress', function (event) {
        if (event.charCode && event.charCode!=0 && event.charCode!=46 && (event.charCode < 48 || event.charCode > 57) ) {
            return false;
        }
    });
    this.count_input.on('input', function () {
        $('#inlineRadio3').val($this.count_input.val());
    });
}

$(function()
{
    if($('.conclusion_generator').length > 0 && !$('body').hasClass('result-generator'))
    {
        new ConclusionGenerator();
    }
});
