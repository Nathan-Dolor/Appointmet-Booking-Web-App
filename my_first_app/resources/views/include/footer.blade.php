@if(Route::currentRouteName() != 'welcome')
  <footer class="bg-dark text-center text-white footer">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    Copyright ©<span id="currentYear"></span>. All Rights Reserved. 
    </div>
  </footer>
  @endif 