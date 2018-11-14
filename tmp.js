fetch('http://localhost/front02_proj/login_api.php',{
    method: "POST",
    mode: "cors",
    headers: {
        // "Content-Type": "application/json; charset=utf-8",
        "Content-Type": "application/x-www-form-urlencoded",
    },
    body: 'email=aaa@bbb.com&password=123456'
}).then(function(response){
    return response.text();
}).then(function(txt){
    console.log(txt);
});