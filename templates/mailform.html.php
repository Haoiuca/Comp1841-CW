<h2>Contact Us</h2>

<p>Have a question about the Student Forum? Send us a message!</p>

<?php if (isset($messageStatus)): ?>
    <script>
        <?php if ($messageStatus === 'success'): ?>
            alert("Success! Your simulated message has been processed.");
        <?php elseif ($messageStatus === 'error'): ?>
            alert("Error: Please provide a valid email address.");
        <?php endif; ?>
    </script>
<?php endif; ?>

<form action="" method="POST">
    <div>
        <label for="email">Your Email Address:</label><br>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div style="margin-top: 10px;">
        <label for="message">Your Message:</label><br>
        <textarea id="message" name="message" rows="5" cols="50" required></textarea>
    </div>
    
    <div style="margin-top: 15px;">
        <input type="submit" value="Send Email">
    </div>
</form>