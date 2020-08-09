function delete_alert(e){
  if(!window.confirm('ユーザー情報は全て削除されます。本当に退会しますか？')){
     window.alert('キャンセルされました'); 
     return false;
  }
  document.deleteform.submit();
};