function placeForm(){
    window.onresize = function(){
        verticalAlign($(document).height(), document.getElementById("container"));
    };
    window.oncontextmenu = function(){return false;};
    $('#container').fadeIn(500);
    verticalAlign($(document).height(),document.getElementById("container"));
}

function verticalAlign(containerHeight,content){
    var marginTop = Math.floor(containerHeight/2)-Math.floor(content.scrollHeight/2);
    if(marginTop<0)
        marginTop = 0;
    content.style.marginTop = marginTop + "px";
}

function removeFromArray(index,list){
    var temp = new Array();
    for(var i=0;i<list.length;i++){
        if(i!=index){
            temp.push(list[i]);
        }
    }
    return temp;
}

function inArray(list,element){
    for(var i=0;i<list.length;i++)
        if(list[i]==element)
            return true;
    return false;
}

function idle(){
    video = document.getElementById('avatar-vid');
    video.currentTime = 13;
}

video = document.getElementById('avatar-vid');

video.addEventListener('loadedmetadata', function() {
    this.play();
    setTimeout(idle ,2000);
}, false);

video.addEventListener('ended', function(){
    this.currentTime = 13;
    this.play();
});

