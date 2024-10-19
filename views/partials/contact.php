
<section class="section_contact" id="contact">
      <div class="contact__container">
        <div class="contact__content">
          <h2 class="section__header">Contact <span>Us</span></h2>
          <form class="contact__form" action="/contact" method="POST">
            <div class="contact__form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" placeholder="Enter your name" />
            </div>
            <div class="contact__form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Enter your email" />
            </div>
            <div class="contact__form-group">
              <label for="message">Message</label>
              <textarea id="message" name="message" placeholder="Enter your message"></textarea>
            </div>
            <button type="submit" name="submit" class="btn">Send Message</button>
          </form>
        </div>
      </div>
    </section>    

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        var messageText = "<?= $_SESSION['status'] ?? ''; ?>";
        
        if (messageText != '') {
            
            swal({
                title: "Thank you!",
                text: messageText,
                icon: "success",
            });
            <?php unset($_SESSION['status']); ?>
        }
        
    </script>