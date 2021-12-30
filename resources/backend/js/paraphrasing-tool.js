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

    this.validator = new Validator([
        {
            field: this.fields.text,
            rules: 'required|min:3|max:5000',
            // rules: 'required|min:200|max:5000',
            selectors: {
                insert_position: 'parent_last',
                span_error: '.error-message',
                parent: '.form-group'
            },
            messages: {
                required: "You must provide a text that is at least 200 words or 1000 characters long.",
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
    this.submit.click($.proxy(this.onSubmitParaphrasingTool, this));
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
        return;
    }

    var data = {
        excludes: this.fields.excludes.val(),
        text: this.fields.text.val(),
        mode: this.container.find('input[name=mode]:checked').val(),
        _token: this.container.find('input[name=_token]').val(),
    };

    var $this = this;
    $('.loader').css({'display': 'block', 'opacity': .7});

    $.post('/get-paraphrasing-text', data, function(response) {
        // console.log(response);
        $('.loader').css({'display': 'none', 'opacity': 0});
        $this.setValues(JSON.parse(response).paraphrasedContent);
        $this.submit.prop('disabled', false);
        // $this.showResults();
    }).fail(function(data) {
        $('.loader').css({'display': 'none', 'opacity': 0});
        $this.submit.prop('disabled', false);
        validator.addErrorsFromJson(data, true);
    });
};

ParaphrasingTool.prototype.setValues = function(data)
{
    this.fields.text.css('display', 'none');
    this.result_wrap.html(data);
};

$(function()
{
    if($('.paraphrasing_tool').length > 0)
    {
        new ParaphrasingTool();
    }
});
