function ParaphrasingTool()
{
    this.container = $('.paraphrasing_tool');
    this.API_url = 'http://localhost/';
    // this.API_url = 'https://apitools.x7p.org/';
    this.API_key = '53V363XcSVOEsqRtHjxW';
    this.prevArray = [];
    this.nextArray = [];

    this.fields = {
        excludes: this.container.find('textarea[name=excludes]'),
        text: this.container.find('textarea[name=text]'),
        mode: this.container.find('input[name=mode]'),
    }

    this.values = {};

    this.submit = this.container.find('#summarize-button');
    this.result_wrap = this.container.find('.result-text');
    this.clear = this.container.find('.clear-text');
    this.back = this.container.find('.back-action');
    this.next = this.container.find('.next-action');
    this.copy = this.container.find('.copy-text');
    this.download = this.container.find('.download-text');

    this.validator = new Validator([
        {
            field: this.fields.text,
            rules: 'required|min:1000|max:5000',
            selectors: {
                insert_position: 'parent_last',
                span_error: '.error-message',
                parent: '.form-group'
            },
            messages: {
                required: 'You must provide a text that is 1000 characters long.',
                string: {
                    min: 'You must provide a text that is 1000 characters long.',
                    max: '5000 characters MAX.'
                }
            }
        },
    ]);

    this.InitEvents();
}

ParaphrasingTool.prototype.InitEvents = function()
{
    this.fields.text[0].addEventListener('input', this.pasteText);
    this.submit.click($.proxy(this.onSubmitParaphrasingTool, this));
    this.clear.click(this.ClearText.bind(this));
}

ParaphrasingTool.prototype.pasteText = function(event)
{
    var arr = event.target.value.split(' ');
    document.querySelector('.words-count span').innerHTML = arr.length;
    document.querySelector('.words-count').classList.add('active');
    document.querySelector('.clear-text').classList.add('active');
}

ParaphrasingTool.prototype.RemoveChanges = function(event)
{
    event.preventDefault();
    if (!this.prevArray.length) return false;

    // change nextArray
    var str = this.result_wrap[0].innerHTML.replace(/<span class="qtiperar-tooltip opened">(.)+<\/span>/i, '');
    this.nextArray.unshift(str);
    // this.nextArray.unshift(this.prevArray[0]);
    this.next.removeAttr('disabled');

    // change result
    this.result_wrap.html(this.prevArray[0]);
    this.result_wrap.find('.qtiperar').click(this.InitTooltip.bind(this));

    // remove last change
    this.prevArray.splice(0, 1);

    if (!this.prevArray.length) {
        this.back.attr('disabled', 'disabled');
    }
}

ParaphrasingTool.prototype.AddChanges = function(event)
{
    event.preventDefault();
    if (!this.nextArray.length) return false;

    // change result
    this.result_wrap.html(this.nextArray[0]);
    this.result_wrap.find('.qtiperar').click(this.InitTooltip.bind(this));

    // // change nextArray
    // this.prevArray.unshift(this.nextArray[0]);
    // this.prev.removeAttr('disabled');

    // remove next change
    this.nextArray.splice(0, 1);

    if (!this.nextArray.length) {
        this.next.attr('disabled', 'disabled');
    }
}

ParaphrasingTool.prototype.ClearText = function(event)
{
    event.preventDefault();
    document.querySelector('.words-count span').innerHTML = 0;
    this.fields.text.val('');
}

ParaphrasingTool.prototype.GetDownloadLinks = function()
{
    var data = {
        key: this.API_key,
        text: this.result_wrap[0].innerText,
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
        document.querySelector('.download-links').classList.add('active');
        document.querySelector('form .buttons').classList.remove('hidden');
    }, 500);
}

ParaphrasingTool.prototype.CopyText = function(event)
{
    event.preventDefault();

    var textToCopy = this.result_wrap[0].innerText;
    var tooltip = document.querySelector('.copy-text .tooltip');

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text).then(() => {
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

ParaphrasingTool.prototype.CloseTooltip = function(event)
{
    event.stopPropagation();

    var tooltips = document.querySelectorAll('.qtiperar-tooltip');
    for (var tooltip in tooltips) {
        if (tooltips.hasOwnProperty(tooltip)) {
            tooltips[tooltip].remove();
        }
    }
}

ParaphrasingTool.prototype.StopPropagation = function(event)
{
    event.stopPropagation();
}

ParaphrasingTool.prototype.ClickOnListElement = function()
{
    var list = document.querySelectorAll('.scrollbar span');
    for (var el in list) {
        if (list.hasOwnProperty(el)) {
            list[el].addEventListener('click', this.ChangeWord.bind(this));
        }
    }
}

ParaphrasingTool.prototype.TooltipSearchResult = function(event)
{
    event.stopPropagation();
    event.preventDefault();

    var search = event.target.previousElementSibling.value;
    var list = event.target.parentElement.previousElementSibling.querySelectorAll('span');
    var newList = '';
    for (var el in list) {
        if (list.hasOwnProperty(el)) {
            if (list[el].outerText.match(search)) {
                newList += '<span>' + list[el].outerText + '</span>'
            }
        }
    }
    if (!newList) {
        newList = 'Noting found...'
    }

    event.target.parentElement.previousElementSibling.innerHTML = newList;

    ParaphrasingTool.prototype.ClickOnListElement();
}

ParaphrasingTool.prototype.TooltipUseResult = function(event)
{
    event.stopPropagation();
    event.preventDefault();

    var newText = event.target.previousElementSibling.value;
    if (!newText) return false;
    this.ChangeWord(event, newText);
}

ParaphrasingTool.prototype.ChangeWord = function(event, text = false)
{
    event.stopPropagation();

    // add step on history array
    var str = this.result_wrap[0].innerHTML.replace(/<span class="qtiperar-tooltip opened">(.)+<\/span>/i, '');
    this.prevArray.unshift(str);
    this.back.removeAttr('disabled');

    var newText = text ? text : event.target.outerText;
    var oldText = '';
    var id = '';
    var words = document.querySelectorAll('.result-text b');
    for (var el in words) {
        if (words.hasOwnProperty(el)) {
            if (words[el].querySelector('.qtiperar-tooltip')) {
                oldText = words[el].outerText.split('\n')[0];
                id = el;
            }
        }
    }

    event.target.closest('.qtiperar').innerText = newText;
}

ParaphrasingTool.prototype.InitTooltip = function(event)
{
    this.CloseTooltip(event);

    // parent block sizes
    var parentHeight = event.target.closest('.result-text').scrollHeight;
    var parentWidth = event.target.closest('.result-text').offsetWidth;
    // position
    var offsetTop = event.target.offsetTop;
    var offsetLeft = event.target.offsetLeft;
    var offsetHeight = event.target.offsetHeight;
    // add classes
    var classes = '';

    if (parentWidth - offsetLeft < 230) {
        classes += ' right-to-left';
    }
    if (offsetHeight > 18) {
        classes += ' move-to-top';
    }
    if (parentHeight - offsetTop < 164) {
        classes += ' bottom-to-top';
    }

    var str = event.target.getAttribute('data-title');
    var arr = str.split('|');
    var html = '';
    var search = '';

    for (var i = 0; i < arr.length; i++) {
        html += '<span>' + arr[i] + '</span>';
    }
    search = '<span class="search"><input type="text" placeholder="Your suggestion"><button>Use</button></span>';
    var content = '<span class="qtiperar-tooltip' + classes + '"><span class="scrollbar">' + html + '</span>' + search + '<span class="close"></span></span>';
    event.target.insertAdjacentHTML('beforeend', content);
    event.target.querySelector('.qtiperar-tooltip').classList.add('opened');

    event.target.querySelector('.close').addEventListener('click', this.CloseTooltip);
    if (event.target.querySelector('.search')) {
        event.target.querySelector('.search input').addEventListener('click', this.StopPropagation);
        event.target.querySelector('.search button').addEventListener('click', this.TooltipUseResult.bind(this));
    }

    this.ClickOnListElement();
}

ParaphrasingTool.prototype.onSubmitParaphrasingTool = function(event)
{
    event.preventDefault();

    if (!document.querySelector('body').classList.contains('result-paraphrasing')) {
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
            excludes: this.fields.excludes.val(),
            text: this.fields.text.val(),
            mode: this.container.find('input[name=mode]:checked').val(),
            _token: this.container.find('input[name=_token]').val(),
        }

        var $this = this;
        $this.container.addClass('loading');

        $.post(this.API_url + 'api/paraphrasing-text', data, function(response) {
            setTimeout( () => {
                $this.container.removeClass('loading');
                document.querySelector('body').classList.add('result-paraphrasing');
                $this.setValues(JSON.parse(response).paraphrasedContent);
                $this.submit.prop('disabled', false);
            }, 500);
        }).fail(function(data) {
            $this.container.removeClass('loading');
            $this.submit.prop('disabled', false);
            validator.addErrorsFromJson(data, true);
        });
    }
}

ParaphrasingTool.prototype.setValues = function(data)
{
    this.fields.text.val('');
    this.result_wrap.html(data);

    this.result_wrap.find('.qtiperar').click(this.InitTooltip.bind(this));
    // this.container.find('.qtiperar').click(this.InitTooltip.bind(this));
    this.copy.click(this.CopyText.bind(this));
    this.download.click(this.GetDownloadLinks.bind(this));
    this.next.click(this.AddChanges.bind(this));
    this.back.click(this.RemoveChanges.bind(this));

    this.container.find('.radio-buttons').css('display', 'block');
    this.container.find('.radio-buttons .text').html('Need better results? <a href="' + $('.conclusion-generator-prices .button').attr('href') + '">Get expert editing help!</a>');
    this.submit.text('New Rephrase');
    this.submit.attr('onclick', 'window.location.reload()');
}

$(function()
{
    if($('.paraphrasing_tool').length > 0)
    {
        new ParaphrasingTool();
    }
});
