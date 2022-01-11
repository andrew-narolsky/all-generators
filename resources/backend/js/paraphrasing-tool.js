function ParaphrasingTool()
{
    this.container = $('.paraphrasing_tool');

    this.fields = {
        excludes: this.container.find('input[name=excludes]'),
        text: this.container.find('textarea[name=text]'),
        mode: this.container.find('input[name=mode]'),
    };

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
            rules: 'required|min:100|max:5000',
            selectors: {
                insert_position: 'parent_last',
                span_error: '.error-message',
                parent: '.form-group'
            },
            messages: {
                required: "You must provide a text that is at least 200 words or :min characters long.",
                string: {
                    min: 'You must provide a text that is at least 200 words or :min characters long.',
                    max: ':max characters MAX.'
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
}

ParaphrasingTool.prototype.pasteText = function(event)
{
    document.querySelector('.words-count span').innerHTML = event.target.value.length;
    document.querySelector('.words-count').classList.add('active');
}

ParaphrasingTool.prototype.RemoveChanges = function(event)
{
    event.preventDefault();
    if (!window.textData) return false;

    var id = window.textData.id;
    var oldText = window.textData.oldText;
    var newText = window.textData.newText;

    var words = document.querySelectorAll('.result-text b');
    words[id].innerText = oldText;

    window.textData = {
        'id' : id,
        'oldText': newText,
        'newText': oldText
    }
}

ParaphrasingTool.prototype.ClearText = function(event)
{
    event.preventDefault();
    document.querySelector('.result-text').innerHTML = '';
    document.querySelector('body').classList.remove('result-paraphrasing');
    document.querySelector('.download-links').classList.remove('active');

    document.querySelector('.words-count span').outerText = 0;
    document.querySelector('.words-count').classList.remove('active');
}

ParaphrasingTool.prototype.GetDownloadLinks = function()
{
    var data = {
        text: this.result_wrap[0].innerText,
        ext: ''
    }

    this.container.addClass('loading');
    document.querySelector('form .buttons').classList.add('hidden');

    // pdf
    $.post('/get-pdf-document-link', data, function(response) {
        document.querySelector('.pdf').href = response;
    }).fail(function() {
        console.log('error');
    });

    // doc
    data.ext = 'doc';
    $.post('/get-word-document-link', data, function(response) {
        document.querySelector('.doc').href = response;
    }).fail(function() {
        console.log('error');
    });

    // docx
    data.ext = 'docx';
    $.post('/get-word-document-link', data, function(response) {
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

    var text = this.result_wrap[0].innerText;
    var tooltip = document.querySelector('.copy-text .tooltip');

    navigator.clipboard.writeText(text).then(() => {
        tooltip.classList.add('opened');
        setTimeout(function () {
            tooltip.classList.remove('opened');
        }, 1500);
    })
    .catch(error => {
        console.log('Something went wrong', error);
    });
}

ParaphrasingTool.prototype.CloseTooltip = function(event)
{
    event.stopPropagation();

    var tooltips = document.querySelectorAll('.qtiperar-tooltip');
    for (let tooltip in tooltips) {
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
    for (let el in list) {
        if (list.hasOwnProperty(el)) {
            list[el].addEventListener('click', this.ChangeWord);
        }
    }
}

ParaphrasingTool.prototype.TooltipSearchResult = function(event)
{
    event.stopPropagation();
    event.preventDefault();

    var search = event.target.previousElementSibling.value;
    var list = event.target.parentElement.previousElementSibling.querySelectorAll('span');
    let newList = '';
    for (let el in list) {
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
    ParaphrasingTool.prototype.ChangeWord(event, newText);
}

ParaphrasingTool.prototype.ChangeWord = function(event, text = false)
{
    event.stopPropagation();

    var newText = text ? text : event.target.outerText;
    var oldText = '';
    var id = '';
    var words = document.querySelectorAll('.result-text b');
    for (let el in words) {
        if (words.hasOwnProperty(el)) {
            if (words[el].querySelector('.qtiperar-tooltip')) {
                oldText = words[el].outerText.split('\n')[0];
                id = el;
            }
        }
    }

    window.textData = {
        'id' : id,
        'oldText': oldText,
        'newText': newText
    }

    event.target.closest('.qtiperar').innerText = newText;
}

ParaphrasingTool.prototype.InitTooltip = function(event)
{
    this.CloseTooltip(event);

    // parent block sizes
    var parentHeight = event.target.closest('.result-text').scrollHeight
    var parentWidth = event.target.closest('.result-text').offsetWidth
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

    for (let i = 0; i < arr.length; i++) {
        html += '<span>' + arr[i] + '</span>';
    }
    search = '<span class="search"><input type="text" placeholder="Your suggestion"><button>Use</button></span>';
    let content = '<span class="qtiperar-tooltip' + classes + '"><span class="scrollbar">' + html + '</span>' + search + '<span class="close"></span></span>';
    event.target.insertAdjacentHTML('beforeend', content);
    event.target.querySelector('.qtiperar-tooltip').classList.add('opened');

    event.target.querySelector('.close').addEventListener('click', this.CloseTooltip);
    if (event.target.querySelector('.search')) {
        event.target.querySelector('.search input').addEventListener('click', this.StopPropagation);
        event.target.querySelector('.search button').addEventListener('click', this.TooltipUseResult);
    }

    this.ClickOnListElement();
}

ParaphrasingTool.prototype.onSubmitParaphrasingTool = function(event)
{
    event.preventDefault();
    this.submit.prop('disabled', true);

    var validator = this.validator;

    this.validator.clearErrors();
    this.validator.forceValidate();

    if (validator.hasErrors(true)) {
        this.submit.prop('disabled', false);
        return false;
    }

    var data = {
        excludes: this.fields.excludes.val(),
        text: this.fields.text.val(),
        mode: this.container.find('input[name=mode]:checked').val(),
        _token: this.container.find('input[name=_token]').val(),
    };

    var $this = this;
    $this.container.addClass('loading');

    $.post('/paraphrasing-text', data, function(response) {
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
};

ParaphrasingTool.prototype.setValues = function(data)
{
    this.fields.text.val('');
    this.result_wrap.html(data);

    this.container.find('.qtiperar').click(this.InitTooltip.bind(this));
    this.clear.click(this.ClearText.bind(this));
    this.copy.click(this.CopyText.bind(this));
    this.download.click(this.GetDownloadLinks.bind(this));
    this.next.click(this.RemoveChanges.bind(this));
    this.back.click(this.RemoveChanges.bind(this));

    this.container.find('.radio-buttons').css('display', 'block');
    this.container.find('.radio-buttons .text').html('Need better results? <a href="' + $('.prices .button').attr('href') + '">Get expert editing help!</a>');
    this.submit.text('Resubmit');
    this.submit.attr('onclick', 'window.location.reload()');
};

$(function()
{
    if($('.paraphrasing_tool').length > 0)
    {
        new ParaphrasingTool();
    }
});
