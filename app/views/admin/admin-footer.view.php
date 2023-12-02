</div>
    </main>
  </div>
</div>
<!-- <script src="<?=ROOT?>assets/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js" integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp" crossorigin="anonymous"></script>
    <script src="<?=ROOT?>assets/js/dashboard.js"></script>
    <script>
      let links=document.querySelectorAll('.nav a');
      console.log(window.location.href);
      for (let i = 0; i < links.length; i++) {
        if(window.location.href==links[i].href){
          links[i].classList.add('active');
        }
        
      }
    </script>
  </body>
</html>
