

if ( typeof preset !== 'object' || preset !== null) {
    if ( typeof getParameterByName('filllen') !== 'object' || getParameterByName('filllen') !== null) {

        fillLen = getParameterByName('filllen');
    }

    if ( typeof getParameterByName('c') !== 'object' || getParameterByName('c') !== null) {
        cutCount = getParameterByName('c');
    }
    if ( typeof getParameterByName('cutdiam') !== 'object' || getParameterByName('cutdiam') !== null) {
        cutDiam = getParameterByName('cutdiam');
    }
    
    if ( typeof getParameterByName('cutfillmat') !== 'object' || getParameterByName('cutfillmat') !== null) {
        cutFillMat = getParameterByName('cutfillmat');
    }
    if ( typeof getParameterByName('cutfillrad') !== 'object' || getParameterByName('cutfillrad') !== null) {
        cutFillRad = getParameterByName('cutfillrad')
    }
    if ( typeof getParameterByName('cutmat') !== 'object' || getParameterByName('cutmat') !== null) {
        cutMat = getParameterByName('cutmat')
    }
    if ( typeof getParameterByName('cuttype') !== 'object' || getParameterByName('cuttype') !== null) {
        cutType = getParameterByName('cuttype')
    }
    if ( typeof getParameterByName('bodylen') !== 'object' || getParameterByName('bodylen') !== null) {
        bodyLen = getParameterByName('bodylen')
    }
    if ( typeof getParameterByName('bodydiam') !== 'object' || getParameterByName('bodydiam') !== null) {
        bodyDiam = getParameterByName('bodydiam')
    }
    if ( typeof getParameterByName('bodydiamtop') !== 'object' || getParameterByName('bodydiamtop') !== null) {
        bodyDiamTop = getParameterByName('bodydiamtop')
    }
    if ( typeof getParameterByName('bodydiambot') !== 'object' || getParameterByName('bodydiambot') !== null) {
        bodyDiamBot = getParameterByName('bodydiambot')
    }

    if ( typeof getParameterByName('bodymat') !== 'object' || getParameterByName('bodymat') !== null) {
        bodyMaterial = getParameterByName('bodymat')
    }

    if ( typeof getParameterByName('filldiam') !== 'object' || getParameterByName('filldiam') !== null) {
        fillDiam = getParameterByName('filldiam')
    }
    if ( typeof getParameterByName('filldiamtop') !== 'object' || getParameterByName('filldiamtop') !== null) {
        fillDiamTop = getParameterByName('filldiamtop')
    }

    if ( typeof getParameterByName('filldiambot') !== 'object' || getParameterByName('filldiambot') !== null) {
        fillDiamBot = getParameterByName('filldiambot')
    }

    if ( typeof getParameterByName('fillmat') !== 'object' || getParameterByName('fillmat') !== null) {
        fillMaterial = getParameterByName('fillmat')
    }

} else {

    cutCount = getParameterByName('c');
    cutDiam = getParameterByName('cutdiam');
    cutFillRad = getParameterByName('cutfillrad');
    cutFillMat = getParameterByName('cutfilmat');
    cutFillMatArr = new Array();
    cutMat = getParameterByName('cutmat');
    cutType = getParameterByName('cuttype');

    bodyLen = getParameterByName('bodylen');
    bodyDiam = getParameterByName('bodydiam');
    bodyDiamTop = getParameterByName('bodydiamtop');
    bodyDiamBot = getParameterByName('bodydiambot');
    bodyMaterial = getParameterByName('bodymat');

    fillDiam = getParameterByName('filldiam');
    fillDiamTop = getParameterByName('filldiamtop');
    fillDiamBot = getParameterByName('filldiambot');
    fillMaterial = getParameterByName('fillmat');
    fillLen = getParameterByName('filllen');

}



console.log( typeof bodyMaterial + ' ' + bodyMaterial);

if ( typeof bodyMaterial !== 'string' || bodyMaterial == '') {
    bodyMaterial = blackPBR;
}

if ( typeof bodyDiam === 'object' || bodyDiam === null) {
    bodyDiam = 0.9;
}

if ( typeof bodyDiamTop === 'object' || bodyDiamTop === null) {
    bodyDiamTop = bodyDiam;
}

if ( typeof bodyDiamBot === 'object' || bodyDiamBot === null) {
    bodyDiamBot = bodyDiam;
}

if ( typeof fillMaterial == 'object' || fillMaterial === null) {
    fillMaterial = pvhPBR;
}

if ( typeof fillDiam === 'object' || fillDiam === null) {
    fillDiam = 0.6;
}

if ( typeof fillDiamTop === 'object' || fillDiamTop === null) {
    fillDiamTop = fillDiam;
}

if ( typeof fillDiamBot === 'object' || fillDiamBot === null) {
    fillDiamBot = fillDiam;
}

if ( typeof bodyLen !== 'string' || bodyLen == null) {
    bodyLen = 2;
}

if ( typeof fillLen !== 'string' || fillLen === null) {
    fillLen = 0.3;
}

if ( typeof cutDiam === 'object' || cutDiam === null) {
    cutDiam = 0.3;
}
if ( typeof cutFillRad === 'object' || cutFillRad === null) {
    cutFillRad = 0.5;
}

if (bodyDiam > bodyDiamTop & bodyDiam > bodyDiamBot) {
    bodyDiamTop = bodyDiam;
    bodyDiamBot = bodyDiam;
}

if (fillDiam > fillDiamTop & fillDiam > fillDiamBot) {
    fillDiamTop = fillDiam;
    fillDiamBot = fillDiam;
}

 if(getParameterByName('cutfirst')==0 || typeof getParameterByName('cutfirst') === 'object'){
     
 }else
 {
     cutDiam = parseFloat(getParameterByName('cutdiam'));
     console.log('cutDiam: '+cutDiam);
     cutFillRad=parseFloat(cutDiam+0.007);
     fillDiam=parseFloat(cutFillRad+0.023);
     bodyDiam=parseFloat(fillDiam+0.028);
     bodyDiamTop=bodyDiam;
     bodyDiamBot=bodyDiam;
     fillDiamTop=fillDiam;
     fillDiamBot=fillDiam;
     
 }

console.log('body : ' + bodyMaterial);
console.log('fill: ' + fillMaterial); 
