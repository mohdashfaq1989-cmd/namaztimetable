function sendOtp(){
let mobile=document.getElementById('mobile').value;

fetch('auth/send_otp',{
method:'POST',
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:'mobile='+mobile
}).then(r=>r.json()).then(d=>alert(d.msg));
}

function verifyOtp(){
let mobile=document.getElementById('mobile').value;
let otp=document.getElementById('otp').value;

fetch('auth/verify_otp',{
method:'POST',
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:'mobile='+mobile+'&otp='+otp
}).then(r=>r.json()).then(d=>alert(d.msg));
}
