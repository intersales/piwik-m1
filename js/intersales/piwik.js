var IntersalesPiwik = {};

IntersalesPiwik.Notice = Class.create();
IntersalesPiwik.Notice.prototype = {
    initialize : function(url, noticeId, noticeButtonId) {
        this.url = url;
        this.noticeId = noticeId;
        this.noticeButtonId = noticeButtonId;

        this._addOnClickListenerToNoticeButton();
    }, _addOnClickListenerToNoticeButton: function() {
        $(this.noticeButtonId).observe('click', function(event) {
            new Ajax.Request(this.url, {
                method: 'get',
                onSuccess: function(transport) { $(this.noticeId).hide(); }.bind(this)
            });
        }.bind(this));
    }
}