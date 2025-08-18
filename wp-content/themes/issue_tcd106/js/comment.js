/*
Author: mg12
Author URI: http://www.neoease.com/
*/
(function() {

function $(id) {
    return document.getElementById(id);
}

function reply(authorId, commentId, commentBox, event) {
    if (event) event.preventDefault(); // prevent default action
    
    var author = MGJS.$(authorId).innerHTML;
    var insertStr = '<a href="#' + commentId + '">@' + author.replace(/\t|\n|\r\n/g, "") + '</a> \n';

    appendReply(insertStr, commentBox);
}

function quote(authorId, commentId, commentBodyId, commentBox, event) {
    if (event) event.preventDefault(); // prevent default action
    
    var author = MGJS.$(authorId).innerHTML;
    var comment = MGJS.$(commentBodyId).innerHTML;

    var insertStr = '<blockquote cite="#' + commentBodyId + '">';
    insertStr += '\n<a href="#' + commentId + '">' + author.replace(/\t/g, "") + '</a> :';
    insertStr += comment.replace(/\t/g, "");
    insertStr += '</blockquote>\n';

    insertQuote(insertStr, commentBox);
}

function insertQuote(insertStr, commentBox) {
    if(MGJS.$(commentBox) && MGJS.$(commentBox).type === 'textarea') {
        var field = MGJS.$(commentBox);
    } else {
        alert("The comment box does not exist!");
        return false;
    }

    if (document.selection) {
        field.focus();
        var sel = document.selection.createRange();
        sel.text = insertStr;
        field.focus();
    } else if (field.selectionStart || field.selectionStart === '0') {
        var startPos = field.selectionStart;
        var endPos = field.selectionEnd;
        var cursorPos = startPos;
        field.value = field.value.substring(0, startPos)
                    + insertStr
                    + field.value.substring(endPos, field.value.length);
        cursorPos += insertStr.length;
        field.focus();
        field.selectionStart = cursorPos;
        field.selectionEnd = cursorPos;
    } else {
        field.value += insertStr;
        field.focus();
    }
}

// DOM読み込み後にpreventDefaultを適用
document.addEventListener("DOMContentLoaded", function() {
    var links = document.querySelectorAll("a[href^='#']");
    links.forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault();
        });
    });
});

// すべての関数をグローバルオブジェクトに登録
window['MGJS'] = {};
window['MGJS']['$'] = $;
window['MGJS_CMT'] = {};
window['MGJS_CMT']['reply'] = reply;
window['MGJS_CMT']['quote'] = quote;
window['MGJS_CMT']['insertQuote'] = insertQuote;

})();
