function EssayMaker()
{
    this.container = $('.essay_maker');
    this.API_url = 'http://localhost/';
    this.API_key = '53V363XcSVOEsqRtHjxW';

    this.fields = {
        text: this.container.find('input[name=text]'),
    }

    this.values = {};

    this.submit = this.container.find('#summarize-button');
    this.result_wrap = this.container.find('.result-text');
    this.clear = this.container.find('.clear-text');
    this.copy = this.container.find('.copy-text');
    this.download = this.container.find('.download-text button');
    this.close_tooltip = this.container.find('.close-tooltip');
    this.reload = this.container.find('.reload');

    this.validator = new Validator([
        {
            field: this.fields.text,
            rules: 'required|min:3',
            selectors: {
                insert_position: 'parent_last',
                span_error: '.error-message',
                parent: '.form-group'
            },
            messages: {
                required: 'You must provide a text that is 3 characters long.',
                string: {
                    min: 'You must provide a text that is 3 characters long.',
                }
            }
        },
    ]);

    this.InitEvents();
}

EssayMaker.prototype.InitEvents = function()
{
    this.submit.click(this.onSubmitEssayMaker.bind(this));
    this.clear.click(this.ClearText.bind(this));
}

EssayMaker.prototype.ReloadWindow = function(event)
{
    event.preventDefault();
    window.location = location.href;
}

EssayMaker.prototype.closeButtonsTooltip = function(event)
{
    event.stopPropagation();
    document.querySelector('.download-text').classList.remove('active');
}

EssayMaker.prototype.ClearText = function(event)
{
    event.preventDefault();
    this.fields.text.val('');
    this.result_wrap.val('');
    this.copy.prop('disabled', true);
    this.download.prop('disabled', true);

    this.result_wrap.on('input', this.ResultWrapChange.bind(this));
}

EssayMaker.prototype.ResultWrapChange = function()
{
    if (this.result_wrap.val() && this.copy.prop('disabled') === true) {
        this.copy.prop('disabled', false);
        this.download.prop('disabled', false);
    }
}

EssayMaker.prototype.GetDownloadLinks = function(event)
{
    event.preventDefault();

    this.close_tooltip.click(this.closeButtonsTooltip);

    var data = {
        key: this.API_key,
        text: this.result_wrap[0].value,
        ext: ''
    }

    this.container.addClass('loading');
    document.querySelector('form .buttons').classList.add('hidden');

    // pdf
    $.post(this.API_url + 'api/get-pdf-document-link', data, function(response) {
        document.querySelector('.pdf').href = response;
    }).fail(function() {
        console.log('error');
    });

    // doc
    data.ext = 'doc';
    $.post(this.API_url + 'api/get-word-document-link', data, function(response) {
        document.querySelector('.doc').href = response;
    }).fail(function() {
        console.log('error');
    });

    // docx
    data.ext = 'docx';
    $.post(this.API_url + 'api/get-word-document-link', data, function(response) {
        document.querySelector('.docx').href = response;
    }).fail(function() {
        console.log('error');
    });

    setTimeout( () => {
        this.container.removeClass('loading');
        document.querySelector('.download-text').classList.add('active');
        document.querySelector('form .buttons').classList.remove('hidden');
    }, 500);
}

EssayMaker.prototype.CopyText = function(event)
{
    event.preventDefault();

    var textToCopy = this.result_wrap[0].value;
    var tooltip = document.querySelector('.copy-text .tooltip');

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(textToCopy).then(() => {
            tooltip.classList.add('opened');
            setTimeout(function () {
                tooltip.classList.remove('opened');
            }, 1500);
        }).catch(error => {
            console.log('Something went wrong', error);
        });
    } else {
        // text area method
        let textArea = document.createElement("textarea");
        textArea.value = textToCopy;
        // make the textarea out of viewport
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        return new Promise((res, rej) => {
            // here the magic happens
            document.execCommand('copy') ? res() : rej();
            textArea.remove();
            tooltip.classList.add('opened');
            setTimeout(function () {
                tooltip.classList.remove('opened');
            }, 1500);
        });
    }
}

EssayMaker.prototype.onSubmitEssayMaker = function(event)
{
    event.preventDefault();

    if (!document.querySelector('body').classList.contains('result-essay-maker')) {
        this.submit.prop('disabled', true);

        var validator = this.validator;

        this.validator.clearErrors();
        this.validator.forceValidate();

        if (validator.hasErrors(true)) {
            this.submit.prop('disabled', false);
            return false;
        }

        var data = {
            key: this.API_key,
            text: this.fields.text.val()
        }

        var $this = this;
        $this.container.addClass('loading');

        $.post(this.API_url + 'api/essay-maker', data, function(response) {
            setTimeout( () => {
                $this.container.removeClass('loading');
                document.querySelector('body').classList.add('result-essay-maker');
                $this.setValues(response.result);
                $this.submit.prop('disabled', false);
            }, 500);
        }).fail(function(data) {
            $this.container.removeClass('loading');
            $this.submit.prop('disabled', false);
            if (data.status === 401) {
                document.querySelector('body').classList.add('limit-essay-maker');
            } else {
                validator.addErrorsFromJson(data, true);
            }
        });
    }
}

EssayMaker.prototype.setValues = function(data)
{
    this.fields.text.val('');
    this.result_wrap.val(data);

    this.copy.click(this.CopyText.bind(this));
    this.download.click(this.GetDownloadLinks.bind(this));
    this.reload.click(this.ReloadWindow.bind(this));
}

$(function()
{
    if($('.essay_maker').length > 0)
    {
        new EssayMaker();
    }
});
