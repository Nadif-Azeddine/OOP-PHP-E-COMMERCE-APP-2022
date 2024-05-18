let i=1;
// setInterval(()=>{
// $('.all .pic').css(
//     'background-image',"url(public/photos/background/landing/0"+i+".jpg)",
    
// );
// if (i>=3) {
//   i=0; 
// }
// i++;
// },5000)

function checkpwwd(){
  if (document.getElementById('checkpwd').value != document.getElementById('pwd').value) {
    document.getElementById('checkpwd').style.border="1px solid red"
    
  }else{
    document.getElementById('checkpwd').style.border="1px solid var(--color1)"
    
  }
 
}
function checkStock(max,id){
  if(document.getElementById('inputNb'+id).value>max){
    document.getElementById('inputNb'+id).value=max
  }
  if( document.getElementById('inputNb'+id).value<=0){
    document.getElementById('inputNb'+id).value=""

  }
  
}
//////////////////////////
function submitform(i){
 $('#form_update_prod_pic'+i).submit()

}
/////////
function togglenav() {
  $('.admin-action').toggleClass('show'); 
  $('.toggle-nav').toggleClass('moveright')
}

/////admin page select an old fur
function selectfurnisher(name,email,tel,add){
  document.getElementById('furname').value=name
  document.getElementById('furemail').value=email
  document.getElementById('furtel').value=tel
  document.getElementById('furaddress').value=add
}
///////
setTimeout(function () {
  $('.alert').slideUp(200)
}, 3000)


// function checkAlertClosed(){
//   chk = sessionStorage.getItem('closeAlert')
//   if (chk == "true") {
//   $('.order-valide-notify').slideUp(300)

//   }

// }

// checkAlertClosed();
////////////
function closeAlert() { 
  sessionStorage.setItem("closeAlert","true")
  $('.order-valide-notify').slideUp(300)
}
setTimeout(function () {
  $('.order-valide-notify').slideUp(200)
}, 5000)

////////