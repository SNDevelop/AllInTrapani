function CheckUserName () {
	var userName = document.RegistrationForm.UserName.value;;
	  
	if (userName == "")
	{
		document.getElementById("msgUserName").innerHTML = "<span style=\"color:red;\">Nome utente è un campo obbligatorio</span><span class=\"hidden\" id=\"resUserNameCheck\">0</span>";
		return;
	}	 	
	
	ValidationOkMsg();
	  
	ajax('msgUserName','bll/dal/checkUser.php?v='+encodeURIComponent(userName));
}

function CheckEmail()
{	
	var email = document.RegistrationForm.email.value;	
	
	if (email == "")
	{
		document.getElementById("msgEmail").innerHTML = "<span style=\"color:red;\">Email è un campo obbligatorio</span><span class=\"hidden\" id=\"resEmailCheck\">0</span>";
		return;
	}	  	
	
	var at = email.indexOf("@");			
	
	if (at == -1 )
	{
		document.getElementById("msgEmail").innerHTML = "<span style=\"color:red;\">Email non valida</span><span class=\"hidden\" id=\"resEmailCheck\">0</span>";
		return;
	}				
				
	var result = email.split("@");		
	var point = result[1].indexOf(".");
	
	if (point == -1)
	{
		document.getElementById("msgEmail").innerHTML = "<span style=\"color:red;\">Email non valida</span><span class=\"hidden\" id=\"resEmailCheck\">0</span>";
		return;
	}
							
	var resPoint = result[1].split(".");		
	var lenRightResPoint = resPoint[1].length;
	var lenLeftResPoint = resPoint[0].length;				
		
	if (lenLeftResPoint < 3 || lenRightResPoint < 2 || lenRightResPoint > 3)
	{
		document.getElementById("msgEmail").innerHTML = "<span style=\"color:red;\">Email non valida</span><span class=\"hidden\" id=\"resEmailCheck\">0</span>";
		return;
	}
	
	ValidationOkMsg();
	
	ajax('msgEmail','bll/dal/checkEmail.php?v='+encodeURIComponent(email));																	
}

function CheckRePassword () 
{
	var password = document.RegistrationForm.Password.value;
	var rePassword = document.RegistrationForm.RePassword.value;
	if(rePassword == "")
	{
		document.getElementById("msgRePassword").innerHTML = "<span style=\"color:red;\">Ripeti password è un campo obbligatorio</span><span class=\"hidden\" id=\"resRePasswordCheck\">0</span>";
		return;
	}		
	
	if (password != rePassword)	
		document.getElementById("msgRePassword").innerHTML = "<span style=\"color:red;\">Le password non coincidono</span><span class=\"hidden\" id=\"resRePasswordCheck\">0</span>";					
	else	
		document.getElementById("msgRePassword").innerHTML = "<img src=\"style/img/ok.png\" alt=\"ok\" title=\"Password Valida\" /><span class=\"hidden\" id=\"resRePasswordCheck\">1</span>";
					
	ValidationOkMsg();					
}

function EnableButton () 
{	
	var iagree = document.RegistrationForm.iagree.checked;	
	var resEmailCheck = document.getElementById("resEmailCheck").innerHTML;		
	var resPasswordCheck = document.getElementById("resPasswordCheck").innerHTML;
	var resUserNameCheck = document.getElementById("resUserNameCheck").innerHTML;
	
	if(resEmailCheck == 1 && resPasswordCheck == 1 && iagree && resUserNameCheck == 1)
	{	
		disabled = false;
		document.getElementById("RegMsg").innerHTML = "Congratulazioni!!!, Hai quasi completato la registrazione sul nostro sito, Dopo aver cliccato su Registrati riceverai una email con il link di attivazione, cliccaci per attivare il tuo account.<br />";
	}								
	else
		disabled = true;				
		
	document.RegistrationForm.Registration.disabled = disabled;				  
}

function ClearMsgIagree()
{
	document.getElementById("msgIagree").innerHTML = '';
	ValidationOkMsg();
}

function ClearMsgPass()
{	
	document.getElementById("msgPassword").innerHTML = '';
	
	if(document.RegistrationForm.RePassword.value != '')
		CheckRePassword();
}

function ValidationOkMsg()
{	
	var iagree = document.RegistrationForm.iagree.checked;
	var resEmailCheck = document.getElementById("resEmailCheck").innerHTML;		
	var resPasswordCheck = document.getElementById("resRePasswordCheck").innerHTML;
	var resUserNameCheck = document.getElementById("resUserNameCheck").innerHTML;
	
	if(iagree && resEmailCheck == 1 && resPasswordCheck == 1 && resUserNameCheck == 1)
		document.getElementById("RegMsg").innerHTML = "<br />Congratulazioni!!!, Hai quasi completato la registrazione sul nostro sito, Dopo aver cliccato su Registrati riceverai una email con il link di attivazione, cliccaci per attivare il tuo account.<br />";
	
	//alert('resEmailCheck = ' + resEmailCheck+' iagree = ' + iagree + ' resPasswordCheck = ' + resPasswordCheck +' resUserNameCheck = ' + resUserNameCheck);					
}

function SubmitClick()
{			
	var iagree = document.RegistrationForm.iagree.checked;
	var emailCheck = document.RegistrationForm.email.value;
	var userNameCheck = document.RegistrationForm.UserName.value;
	var rePasswordCheck = document.RegistrationForm.RePassword.value;
	var passwordCheck = document.RegistrationForm.Password.value;
	
	var resEmailCheck = document.getElementById("resEmailCheck").innerHTML;		
	var resPasswordCheck = document.getElementById("resPasswordCheck").innerHTML;
	var resUserNameCheck = document.getElementById("resUserNameCheck").innerHTML;
	
	if(emailCheck == '')
		document.getElementById("msgEmail").innerHTML = "<span style=\"color:red;\">Email è un campo obbligatorio</span><span class=\"hidden\" id=\"resEmailCheck\">0</span>";		
			
	if(userNameCheck == '')
		document.getElementById("msgUserName").innerHTML = "<span style=\"color:red;\">Nome utente è un campo obbligatorio</span><span class=\"hidden\" id=\"resUserName\">0</span>";
	
	if(passwordCheck == '')
		document.getElementById("msgPassword").innerHTML = "<span style=\"color:red;\">Password è un campo obbligatorio</span><span class=\"hidden\" id=\"resPasswordCheck\">0</span>";
	
	if(rePasswordCheck == '')	
		document.getElementById("msgRePassword").innerHTML = "<span style=\"color:red;\">Repassword è un campo obbligatorio</span><span class=\"hidden\" id=\"resRePasswordCheck\">0</span>";			
	
	if(!iagree)			
		document.getElementById("msgIagree").innerHTML = "<span style=\"color:red;\"><br />Devi accettare il contratto per registrarti</span>";		
		
	if(emailCheck == '' || userNameCheck == '' || passwordCheck == '' || rePasswordCheck == '' || !iagree || resEmailCheck == 0 || resRePasswordCheck == 0 || resUserNameCheck == 0)
		return false;
	else
		return true;	 	
}
/**
 * Super-Easy DimensioneX Ajax Library
 *
 * v. 1.4
 *
 * http://www.dimensionex.net/
 *
 * Cristiano Leoni
 *
 * Fornita gratuitamente cos� com'� senza alcuna garanzia.
 * Licenza: GPL
 *
 */

var loadingimg = "style/img/loading/loading1.gif";

/**
 * Funzione che istanzia un oggetto XMLHttpRequest usando un meccanismo cross browser.
 *
 * restituisce un'istanza di XMLHttpRequest oppure il valore false in caso di errori.
 */

function getXMLHttpRequestInstance() {

    var xmlhttp;

    // Prova il metodo Microsoft usando la versione pi� recente:
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {

        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }

    // Se non � stato possibile istanziare l'oggetto forse siamo
    // su Mozilla/FireFox o su un altro browser compatibile:
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        try {
            xmlhttp = new XMLHttpRequest();
        } catch (e) {
            xmlhttp = false;
        }
    }

    // Restituisce infine l'oggetto:
    return xmlhttp;
}

/**
 * Funzione che sostituisce il contenuto HTML di un nodo della pagina.
 *
 * Parametri:
 * nodeId: ID del nodo
 * html:   codice HTML da sostituire a quello del nodo
 */
function updateContent(nodeId, html) {
   
    var node = document.getElementById(nodeId);
    if(null == node) {
		//alert("[ERROR] page does not have any DIV with ID " + nodeId);
		return;
    }
    node.innerHTML = html;
    node.style.visibility = "visible";
}

/**
 * Richiede al web server un contenuto in maniera asincrona.
 * @param    nodeId    ID dell'elemento della pagina che conterr� il contenuto
 * @param    url       URL del contenuto (deve essere sullo stesso server per motivi di sicurezza)
 * @param    url       Opzionale, URL dell'immagine/animazione "loading"
 */
function ajax(nodeId, url, loadimg) {
    loadimg = (typeof loadimg == "undefined")?loadingimg:loadimg;

    var xmlhttp = getXMLHttpRequestInstance();
    if(!xmlhttp) {
        alert("Il browser non supporta l'oggetto XMLHttpRequest");
        return false;
    }
    if (loadimg!=null){
	    updateContent(nodeId,"");
	    updateContent(nodeId,"<img alt='...' src='"+loadimg+"' />");
    }
    
    if (url.indexOf('?')>=0) {
    	url = url+'&tid='+Math.random();
    } else {
    	url = url+'?tid='+Math.random();
    }
    
    //alert(url);

    xmlhttp.open("GET", url,true);
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4) {
            if (xmlhttp.status==200) {
                updateContent(nodeId, xmlhttp.responseText);
                //EnableButton();                    			                                
            } else if (xmlhttp.status==404) {
                alert("[ERROR] un-existing URL: "+url);
            } else {
                alert("[ERROR] un-handled error (" + xmlhttp.status + ")");
            }
        }
    }		
    
    xmlhttp.send(null);                            
}


