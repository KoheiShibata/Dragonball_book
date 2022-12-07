// 二重サブミット対策

function checkSubmit(){
    var obj = document.getElementById("btnSubmit");
    if(obj.disabled){
      //ボタンがdisabledならsubmitしない
      return false;
    }else{
      //ボタンがdisabledでなければ、ボタンをdisabledにした上でsubmitする
      obj.disabled = true;
      return true;
    }
  }