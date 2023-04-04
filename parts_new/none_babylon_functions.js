function isEven(n) {
    return n % 2 == 0;
}

function getUriParam(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'), results = regex.exec(url);
    if (!results)
        return false;
    if (!results[2])
        return false;
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}


function getRealCut(paramCut)
{
    return paramCut*100;
}

function getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min)) + min; //Максимум не включается, минимум включается
}

var parseUri = function(vl,alias)
{
    vlOld = vl;
    if(typeof alias == 'undefined' && alias!='') {
        if (getUriParam(vl, location.href)) {
            vl = eval(getUriParam(vl, location.href));
            return vl;
        } else {
            vl = eval(vlOld);
            return vl;
        }
    }else {
        if (getUriParam(alias, location.href)) {
            vl = eval(getUriParam(alias, location.href));
            return vl;
        } else {
            vl = eval(vlOld);
            return vl;
        }
    }
}

function compareCircles(mainCircle,arrayOfCircles)
{
 //   if(mainCircle=='' || typeof  mainCircle=== 'undefined') { return  false; }
    if(arrayOfCircles==='') {  return false;}
    var totalCirclesLength = 0;
    var mainCirlceLength = 2*Math.PI * mainCircle;
    for(var i=0; i<arrayOfCircles.length; i++)
    {
        totalCirclesLength = totalCirclesLength + (2*Math.PI * arrayOfCircles[i].diameter);
    }

    if(totalCirclesLength*0.7 > mainCirlceLength)
    {
        return false;
    }else
    {
        return true;
    }

}

