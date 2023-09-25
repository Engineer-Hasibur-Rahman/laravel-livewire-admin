<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Load More Data on Button Click using JQuery Laravel - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />



    <!-- SLICK SLIDER CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>


<style>
* {
  font-family: sans-serif;
}
.my-slick-slider {
  width: 330px;
  height: 200px;
}
.item {
  position: relative;
  width: 100px;
  height: 100px;
  overflow: hidden;
  display: block;
} 
.item > h1 {
  position: absolute;
  margin: 5px;
  color: white;
}
.item > h2 {
  position: absolute;
  color: white;
  bottom: 0px;
  right: 15px;
  margin: 5px;
}
img {
  object-fit: cover;
  height: 100px;
  width: 100px;
}
.bttn {
  padding: 8px 12px;
  display: inline-block;
  background-color: lavender;
  border-radius: 20px;
  color: black;
  margin-bottom: 10px;
  cursor: pointer;
  transition: all 0.4s ease;
}
.active {
  background-color: slateblue;
  color: white;
}
</style>

</head>
<body>
      
<div class="container mt-5" style="max-width: 750px">


        <!-- BUILD SLIDER WITH CATS AND DOG PICTURES -->
        <h1>Slick Slider Filter by Class Demo</h1>
        <div data-filtertarget="dog" class="filter-bttn bttn" onclick="filter(this)">dog</div>
        <div data-filtertarget="cat" class="filter-bttn bttn" onclick="filter(this)">cat</div>
        <div data-filtertarget="ALL" class="filter-bttn bttn active" onclick="filter(this)">ALL</div>
            <!-- SLICK SLIDER -->
        <div class="my-slick-slider">
        <div class="item cat">
            <h1>1</h1>
            <h2>This is a good slide</h2>
        </div> 
        </div>

  
    <h1>Load More Data on Button Click using JQuery Laravel</h1>
  
    <div id="data-wrapper">
        @include('data')
    </div>
    
    
    <div class="text-center">
        <button class="btn btn-success load-more-data"><i class="fa fa-refresh"></i> Load More Data...</button>
    </div>
  
    <!-- Data Loader -->
    <div class="auto-load text-center" style="display: none;"> </div>
</div>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>

$('.my-slick-slider').slick({
  centerMode: true,
  centerPadding: '0px',
  slidesToShow: 3,
  infinite: true,
  responsive: false,
  adaptiveHeight: true
});

const filter = (element) => {
  let target = element.dataset.filtertarget;
  resetFilterButtons();
  setFilterButtonActive(target);
  $('.my-slick-slider').slick('slickUnfilter');
  if (target !== "ALL") {
    $('.my-slick-slider').slick('slickFilter', `.${target}`);
  }
};

const resetFilterButtons = () => {
  document.querySelectorAll(".filter-bttn ").forEach(filterBttn => {
    filterBttn.classList.remove("active");
  });
};

const setFilterButtonActive = (target) => {
  console.log(target);
  document.querySelector(`[data-filtertarget=${target}]`).classList.add("active");
};



    var ENDPOINT = "{{ route('blogs.index') }}";
    var page = 1;
  
    $(".load-more-data").click(function(){
        page++;
        infinteLoadMore(page);
    });
  
    /*------------------------------------------
    --------------------------------------------
    call infinteLoadMore()
    --------------------------------------------
    --------------------------------------------*/
    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
            .done(function (response) {
                if (response.html == '') {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                $("#data-wrapper").append(response.html);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
</body>
</html>