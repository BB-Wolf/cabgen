
if (preset == 'onestr'){
cutCount=1;
bodyDiam=0.11;
fillDiam=0.105;
cutFillRad=0.08;
cutDiam=0.05;
cutFillMatArr[1]='nullLinePBR';
bodyMat='blackPBR';
cutLenArr[1]=0.3;
fillLen=0.1;
cutFillLenArr[1]=0.28;
bodyLen=1;
}

if(preset == 'twostr'){
cutCount=2;
bodyDiam=0.095;
fillDiam=0.085;
cutFillRad=0.085;
cutDiam=0.055;
cutFillMatArr[1]='nullLine';
cutFillMatArr[2]='plusLine';
bodyMat='blackPBR';
fillLen=0.1;
bodyLen=0.31;
cutLenArr[1]=0.25;
cutLenArr[2]=0.25;
cutFillLenArr[1]=0.2;
cutFillLenArr[2]=0.2;
}


if (preset == 'onecoppvhblack') {
    cutCount = 1;
    fillDiam = 0.3;
    fillDiamTop = fillDiam;
    fillDiamBot = fillDiam;
    cutDiam = 0.2;
    cutFillRad = 0.27;
    bodyDiam = 0.4;
    bodyDiamTop = bodyDiam;
    bodyDiamBot = bodyDiam;
    cutType = 'copper';
    fillmat = pvhPBR;
    cutFillMat = plusLinePBR;
    cutFillMatArr[0] = 'plusLinePBR';
    bodyMaterial = blackPBR;
}

if (preset == 'onecoppvhpvh') {
    cutCount = 1;
    fillDiam = 0.3;
    fillDiamTop = fillDiam;
    fillDiamBot = fillDiam;
    cutDiam = 0.2;
    cutFillRad = 0.27;
    bodyDiam = 0.4;
    bodyDiamTop = bodyDiam;
    bodyDiamBot = bodyDiam;
    cutType = 'copper';
    fillmat = pvhPBR;
    cutFillMat = nullLinePBR;
    cutFillMatArr[0] = 'plusLinePBR';
    bodyMaterial = pvhPBR;
}

if (preset === 'onealumpvhblack') {
    cutCount = 1;
    fillDiam = 0.3;
    fillDiamTop = fillDiam;
    fillDiamBot = fillDiam;
    cutDiam = 0.2;
    cutFillRad = 0.27;
    bodyDiam = 0.4;
    bodyDiamTop = bodyDiam;
    bodyDiamBot = bodyDiam;
    cutType = 'alum';
    fillMaterial = pvhPBR;
    bodyMaterial = blackPBR;
    cutFillMat = nullLinePBR;
    cutFillMatArr[0] = plusLinePBR;
}

if (preset == 'onealumpvhpvh') {
    cutCount = 1;
    fillDiam = 0.3;
    fillDiamTop = fillDiam;
    fillDiamBot = fillDiam;
    cutDiam = 0.2;
    cutFillRad = 0.27;
    bodyDiam = 0.4;
    bodyDiamTop = bodyDiam;
    bodyDiamBot = bodyDiam;
    cutType = 'alum';
    fillMaterial = pvhPBR;
    bodyMaterial = pvhPBR;
    cutFillMat = nullLinePBR;
    cutFillMatArr[0] = plusLinePBR;
}