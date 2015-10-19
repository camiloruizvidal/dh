$(function()
{
    $('.fecha').datepicker({ dateFormat: 'yy-mm-dd' });
});
function getUrlVars()  //Funcion para llamar datos capturar valores url get ejemplo var second = getUrlVars()["name2"];
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}