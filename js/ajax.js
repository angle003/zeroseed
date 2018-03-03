var xmlHttp

function checkPass(password){
    if(password.length >= 6){
         return true;
    }else{
         return false;
    }
}
function checkEmail(email){
    var regex = /^([0-9A-Za-z\-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)$/g;
    if(regex.test(email)){
        return true;
    }else{
        return false;
    }
}

function showResult1(id)
{
document.blog_id=id;
xmlHttp=GetXmlHttpObject()

if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }

var url="ajax.php"
url=url+"?blog_id="+id
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
} 

function show(id)
{
document.comment_id=id;
xmlHttp=GetXmlHttpObject()

if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }

var url="ajax.php"
url=url+"?comment_id="+id
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
} 

function stateChanged()
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 	if(document.blog_id){
 		var spanId="blog_likes_"+document.blog_id
        document.getElementById(spanId).innerHTML=xmlHttp.responseText;
        document.blog_id=null;
 	}
 	if(document.comment_id){
 		var spanId="blog_comment_likes_"+document.comment_id
        document.getElementById(spanId).innerHTML=xmlHttp.responseText;
        document.comment_id=null;
 	}
 
 } 
}



function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}