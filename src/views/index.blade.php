<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Fileman</title>
  <link rel="stylesheet" href="/vendor/dizytech/fileman/css/bootstrap.css" />
  <link rel="stylesheet" href="/vendor/dizytech/fileman/css/font-awesome.min.css" />
</head>

<body>
  <div id="app">
    <div class="card text-center">
      <div class="card-body">
        <router-view></router-view>
      </div>
    </div>
  </div>
  
</body>
<script src="/vendor/dizytech/fileman/js/vue.js"></script>
<script src="/vendor/dizytech/fileman/js/vue-router.js"></script>
<script src="/vendor/dizytech/fileman/js/jquery.min.js"></script>
<script src="/vendor/dizytech/fileman/js/popper.min.js"></script>
<script src="/vendor/dizytech/fileman/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@include('fileman::pages.files')
<script>
  const accessToken = '{{session()->get("fileman_token")}}';
  const Terbaru = { template: `@include('fileman::pages.terbaru')` }
  const Upload = { template: `@include('fileman::pages.upload')` }
  const routes = [
    { path: '/', component: Files },
    { path: '/files', component: Files },
    { path: '/terbaru', component: Terbaru },
    { path: '/upload', component: Upload }
  ]
  const router = new VueRouter({
    routes
  })
  var app = new Vue({
    mode: 'history',
    router
  }).$mount('#app')
</script>

</html>