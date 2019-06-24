    window.onload=function(){
        setupConfigMenu();
        setupPizzaLijst();
        setupIngredientenPopup();
        setupIngredientenLijst();
        setupForms();
        setupBetaalKnop();


        berekenWinkelkarTotaal();

        console.log("setupJavascript ok");
    }
    function berekenWinkelkarTotaal(){
        if(document.getElementById("sideBarRight")){
            // bereken totaal van winkelkar
            let fieldList=document.querySelectorAll(".priceField");
            let totaalPrijs=0;
            for(let i=0;i<fieldList.length;i++){
                totaalPrijs+= parseFloat(fieldList[i].textContent);
            }
            if(document.getElementById("totalPriceField")){
                document.getElementById("totalPriceField").textContent=totaalPrijs;
            }
        }
    }
function setupBetaalKnop(){
    if(document.getElementById("betaalKnop")){
        document.getElementById("betaalKnop").addEventListener("click",function(e){
            alert("Betaling goedgekeurd!");

        let targetDiv= document.getElementById("betaalDiv");
        let p= document.createElement("p");
        let p2= document.createElement("p");
        p.textContent="Betaling geaccepteerd.";
        p2.textContent="Uw bestelling is onderweg.";
        targetDiv.innerHTML="";
        targetDiv.appendChild(p);
        });
    }

}
function validateForm(form){
    let cbx=form.querySelector("[type=checkbox]");

}
function setupConfigMenu(){
    let config= document.getElementById("topMenu");
    if(config){
        let listItems=config.querySelectorAll("li");

        for(let i=0;i<listItems.length;i++){
           let link= listItems[i].getAttribute("id");
            link= link.replace("Link","Section");

             listItems[i].addEventListener("click",function(e){
                 removeClass("activeConfigLink");
                 listItems[i].classList.add("activeConfigLink");
                 onlyShowSection(link);
             });
        }
       let initVisibleSection="productSection";
        document.getElementById("productLink").classList.add("activeConfigLink");
        onlyShowSection(initVisibleSection);
    }
}
function removeClass(classnameRemove){
    let nodeList=document.querySelectorAll("."+classnameRemove);
    if(nodeList){
        for(let i=0;i<nodeList.length;i++){
            nodeList[i].classList.remove(classnameRemove);
        }
    }
}
function onlyShowSection(sectionId){
    let sectionList=document.querySelectorAll(".config");
    for(let i=0;i<sectionList.length;i++){
        if(sectionList[i].getAttribute("id")==sectionId){
            sectionList[i].style.display="block";
        }else{
            sectionList[i].style.display="none";
        }
    }
}
function setupPizzaLijst(){
    let fieldList=document.querySelectorAll("input[name=btnPlus]");
    for(let i=0;i<fieldList.length;i++){
        let btnPlus= fieldList[i];
        btnPlus.addEventListener("click",function(e){
           let newVal= parseInt(btnPlus.parentNode.querySelector("input[name=aantal]" ).value)+1;
            btnPlus.parentNode.querySelector("input[name=aantal]" ).value=newVal;
        });
    }

    fieldList=document.querySelectorAll("input[name=btnMin]");
    for(let i=0;i<fieldList.length;i++){
        let btnMin= fieldList[i];
        btnMin.addEventListener("click",function(e){
           let newVal= parseInt(btnMin.parentNode.querySelector("input[name=aantal]" ).value)-1;
            if(newVal>=1){
                btnMin.parentNode.querySelector("input[name=aantal]" ).value=newVal;
            }
        });
    }


}
function setupIngredientenLijst(){
    if(document.getElementById("pizzaIngredienten")){
        document.cookie="pizzaIngredienten=;path=/";
        let listItems=document.getElementById("pizzaIngredienten").querySelectorAll("li");
        if(listItems.length>0){
            for(let i=0;i<listItems.length;i++){
                let item=listItems[i];
                if(item.classList.contains("heeftIngredient")){
                    addValueToCookie("pizzaIngredienten",item.getAttribute("id").replace("ingredient",""));
                }
                item.addEventListener("click",function(e){
                    if(item.classList.contains("heeftIngredient")){
                        item.classList.remove("heeftIngredient");
                        removeValueFromCookie("pizzaIngredienten",item.getAttribute("id").replace("ingredient",""));
                    }else{
                        item.classList.add("heeftIngredient");
                        addValueToCookie("pizzaIngredienten",item.getAttribute("id").replace("ingredient",""));
                    }
                });
            }
        }
    }
}
function getCookieValue(cookiename){
    // gets value of cookie, returns empty string when cookie doesn't exist
    let cookieList=document.cookie.split(";");
    let cookieFound=false;
    let returnValue="";
    for(let i=0;i<cookieList.length;i++){
        let cookieValue=cookieList[i].split("=");

        if(cookieValue[0].trim()==cookiename){
            returnValue=cookieValue[1];
        }
    }
    return returnValue;
}
function setCookieValue(cookiename,cookievalue){
    document.cookie=cookiename+"="+cookievalue+";path=/";
}
function addValueToCookie(cookiename,value){
    let cookieValue=getCookieValue(cookiename);

    if(cookieValue==""){
        cookieValue+=value;
    }else{
        cookieValue+="-"+value;
    }
    setCookieValue(cookiename,cookieValue);
}
function removeValueFromCookie(cookiename,value){
    let cookievalue=getCookieValue(cookiename);
    let pos=cookievalue.indexOf(value);
    if(pos==0){
        cookievalue.replace(cookievalue+"-");
    }else{
        cookievalue.replace("-"+cookievalue);
    }
    setCookieValue(cookiename,cookievalue);
}
function setupIngredientenPopup(){
        // popup ingredienten
        let btnList= document.querySelectorAll(".showIngredients");

        for(let i=0;i<btnList.length;i++){
            let btn= btnList[i];
            btn.addEventListener("mouseenter",function(e){
                let ingredientList= btn.parentNode.querySelector("ul");
                let div=document.createElement("div");
                let clonedList=ingredientList.cloneNode(true);
                clonedList.classList.remove("hidden");
                div.appendChild(clonedList);
                div.style.visibility="visible";
                div.style.position="absolute";
                div.style.top=e.clientY-50;
                div.style.left=e.clientX-5;
                div.classList.add("popup");
                btn.addEventListener("mouseleave",function(e){
                    div.style.visibility="hidden";
                });
                btn.parentNode.appendChild(div);
                //document.getElementById("mainSection").appendChild(div);

            });
        }
}
function setupForms(){

    // show/hide e-mail+password input on checkbox click
    let cbx=document.getElementById("createAccount");
     if(cbx){
         cbx.addEventListener("click",function(e){

            let joinElement="visible";
            let otherElement="hidden";
           if(!cbx.checked){
               joinElement="hidden";
               otherElement="visible";
           }

           let fieldList=document.querySelectorAll(".showOnJoin");
            for(let i=0;i<fieldList.length;i++){
                fieldList[i].style.visibility=joinElement
            }
             fieldList=document.querySelectorAll(".hideOnJoin");
            for(let i=0;i<fieldList.length;i++){
                fieldList[i].style.visibility=otherElement
            }
        });
     }


    // add buttons to hide/show join+loginform
    let joinForm= document.getElementById("joinFormWrapper");
    let loginForm= document.getElementById("loginFormWrapper");
    if(joinForm&&loginForm){
        let div1= document.createElement("div");
        div1.classList.add("finalizeButton");
        let p1= document.createElement("p");
        p1.textContent="Ik heb een account.";
        div1.appendChild(p1);

        let div2= document.createElement("div");
        div2.classList.add("finalizeButton");
        let p2= document.createElement("p");
        p2.textContent="Ik heb geen account.";
        div2.appendChild(p2);

        loginForm.parentNode.insertBefore(div1,loginForm);
        joinForm.parentNode.insertBefore(div2,joinForm);



        if(loginForm.querySelectorAll(".error").length>0){
            joinForm.style.display="none";
            loginForm.style.display="block";
            div1.style.display="none";
            div2.style.display="block";
        }else if(joinForm.querySelectorAll(".error").length>0){
            joinForm.style.display="block";
            loginForm.style.display="none";
            div1.style.display="block";
            div2.style.display="none";
        }else{
            joinForm.style.display="none";
            loginForm.style.display="none";
            div1.style.display="block";
            div2.style.display="block";
        }


        div1.addEventListener("click",function(e){
            joinForm.style.display="none";
            loginForm.style.display="block";
            div1.style.display="none";
            div2.style.display="block";
        });
        div2.addEventListener("click",function(e){
            joinForm.style.display="block";
            loginForm.style.display="none";
            div1.style.display="block";
            div2.style.display="none";

        });
    }

}
