function autofitIframe(id) 
{
    if (!window.opera && document.all && document.getElementById) {
        id.style.height = id.contentWindow.document.body.scrollHeight;
    } else if (document.getElementById) {
        id.style.height = id.contentDocument.body.scrollHeight + "px";
    }
}
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
function ValuesId(Name)//Funcion para llamar a todos los id que se encuentran en un array html input text
{
    var i = 1;
    var value = [], temp;
    var Funtion = 'input[name^="' + Name + '"]';
    $(Funtion).each(function ()
    {
        temp = document.getElementsByName(Name + '[]');
        value.push(temp);
        i = i + 1;
    });
    return value;
}
function ValueName(Name)
{
    var Values = [];
    $('input[name^="' + Name + '"]').each(function ()
    {
        Values.push(this.value);
    });
    return Values;
}