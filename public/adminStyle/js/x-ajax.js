/**
 * 异步请求
 * @param url               请求地址
 * @param json              请求数据
 * @param type              请求类型
 * @returns {string}        返回字符串
 */
function adminAjax(url, json, type) {
    var res = '';
    $.ajax({
        url: url,
        type: type,
        data: json,
        dataType: 'json',
        success: function (data) {
            res = data;
        }
    });

    return res;
}