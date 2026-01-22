<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('AdminLte/plugins/fontawesome-free/css/all.min.css') }}">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="{{ asset('AdminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('AdminLte/dist/css/adminlte.css') }}">
<script data-cfasync="false" nonce="c0cbcf23-aa12-4518-88e3-29ef79a0047c">try{(function(w,d){!function(a,b,c,d){if(a.zaraz)console.error("zaraz is loaded twice");else{a[c]=a[c]||{};a[c].executed=[];a.zaraz={deferred:[],listeners:[]};a.zaraz._v="5848";a.zaraz._n="c0cbcf23-aa12-4518-88e3-29ef79a0047c";a.zaraz.q=[];a.zaraz._f=function(e){return async function(){var f=Array.prototype.slice.call(arguments);a.zaraz.q.push({m:e,a:f})}};for(const g of["track","set","debug"])a.zaraz[g]=a.zaraz._f(g);a.zaraz.init=()=>{var h=b.getElementsByTagName(d)[0],i=b.createElement(d),j=b.getElementsByTagName("title")[0];j&&(a[c].t=b.getElementsByTagName("title")[0].text);a[c].x=Math.random();a[c].w=a.screen.width;a[c].h=a.screen.height;a[c].j=a.innerHeight;a[c].e=a.innerWidth;a[c].l=a.location.href;a[c].r=b.referrer;a[c].k=a.screen.colorDepth;a[c].n=b.characterSet;a[c].o=(new Date).getTimezoneOffset();if(a.dataLayer)for(const k of Object.entries(Object.entries(dataLayer).reduce(((l,m)=>({...l[1],...m[1]})),{})))zaraz.set(k[0],k[1],{scope:"page"});a[c].q=[];for(;a.zaraz.q.length;){const n=a.zaraz.q.shift();a[c].q.push(n)}i.defer=!0;for(const o of[localStorage,sessionStorage])Object.keys(o||{}).filter((q=>q.startsWith("_zaraz_"))).forEach((p=>{try{a[c]["z_"+p.slice(7)]=JSON.parse(o.getItem(p))}catch{a[c]["z_"+p.slice(7)]=o.getItem(p)}}));i.referrerPolicy="origin";i.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(a[c])));h.parentNode.insertBefore(i,h)};["complete","interactive"].includes(b.readyState)?zaraz.init():a.addEventListener("DOMContentLoaded",zaraz.init)}}(w,d,"zarazData","script");window.zaraz._p=async bs=>new Promise((bt=>{if(bs){bs.e&&bs.e.forEach((bu=>{try{const bv=d.querySelector("script[nonce]"),bw=bv?.nonce||bv?.getAttribute("nonce"),bx=d.createElement("script");bw&&(bx.nonce=bw);bx.innerHTML=bu;bx.onload=()=>{d.head.removeChild(bx)};d.head.appendChild(bx)}catch(by){console.error(`Error executing script: ${bu}\n`,by)}}));Promise.allSettled((bs.f||[]).map((bz=>fetch(bz[0],bz[1]))))}bt()}));zaraz._p({"e":["(function(w,d){})(window,document)"]});})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};</script></head>
<body class="hold-transition login-page">
<div class="login-box">
<!-- /.login-logo -->
<body class="hold-transition login-page" style="background: linear-gradient(135deg, #3a8dde, #6dd5ed); font-family: 'Source Sans Pro', sans-serif;">

<div class="login-box">
  <div class="card shadow-lg border-0 rounded-3 card-outline card-primary">
    <div class="card-header text-center bg-gradient-primary text-white rounded-top">
      <a href="#" class="h2 text-white"><b>MASUK</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg text-muted mb-4">Silakan masuk untuk melanjutkan</p>

      <form action="{{ route('postlogin') }}" method="post">
        {{ csrf_field() }}
        
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text bg-white">
              <span class="fas fa-envelope text-primary"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text bg-white">
              <span class="fas fa-lock text-primary"></span>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-8 d-flex align-items-center">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember" class="text-muted"> Ingat saya </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block shadow-sm" style="transition:0.3s;">
              <i class="fas fa-sign-in-alt mr-1"></i> Masuk
            </button>
          </div>
        </div>
      </form>

      <div class="text-center mt-3">
        <a href="#" class="text-primary">Lupa password?</a>
      </div>
    </div>
  </div>
</div>

<div class="mt-3 text-white">
  <p class="title_footer_login">
    <center>Support by <a href="http://riyul.com" class="text-white font-weight-bold">riyul.com</a> & 
    <a href="#" class="text-white font-weight-bold">Rumedia</a></center>
  </p>
</div>

<!-- jQuery -->
<script src="{{ asset('AdminLte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLte/dist/js/adminlte.min.js?v=3.2.0') }}"></script>
</body>
</html>
