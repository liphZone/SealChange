<!DOCTYPE html>
<html lang="en">
 @include('layout.partials.head')
  <body>
    <div class="container-scroller">
     @include('layout.partials.navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('layout.partials.sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- Page Title Header Starts-->
            <div class="row page-title-header">
              <div class="col-12">
                <div class="page-header">
                <!-- Button trigger modal -->
                <button onclick="showModal()" class="btn btn-light">Comment ça fonctionne ? </button>
                </div>
              </div>
              <div class="col-md-12">
               @yield('content')
              </div>
            </div>
               
            <!-- Modal -->
            <div id="modal">
              <div class="modalContent">
                  <div class="modalHeader">
                      <span class="modalClose" onclick="closeModal()">&times;</span>
                      <h2>Comment ça fonctionne </h2>
                  </div>
                  <div class="modalBody">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ultricies augue sollicitudin, pellentesque lectus quis, porttitor mi. Sed sollicitudin est ac neque feugiat, faucibus tempor ex posuere. Maecenas finibus vel libero nec elementum. Donec fringilla dapibus elementum. Praesent dui nibh, semper ut ultrices eget, vehicula et mi. Fusce a ligula rutrum, tincidunt dui vitae, pulvinar odio. Fusce ac lorem non velit efficitur congue at eget risus. Nam consectetur mi non pharetra dignissim. Curabitur porta, ligula a porta fermentum, dolor urna ullamcorper elit, nec bibendum erat ligula nec nisl. Quisque non accumsan elit, eget elementum enim. Mauris dictum hendrerit odio, vel tincidunt turpis lobortis in. Praesent felis risus, gravida ornare faucibus eu, venenatis eget ex. Praesent sed viverra purus, et finibus elit.</p>
                  </div>
              </div>
          </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
            @include('layout.partials.footer')
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="//code.jquery.com/jquery.js"></script>
    @include('flashy::message')

    @include('layout.partials.scriptjs')
  </body>
</html>