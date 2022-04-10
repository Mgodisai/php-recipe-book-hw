<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<div>
   <h1>Kapcsolatfelvétel</h1>
   <form name="contact-form" id="contact-form" method="post" action="index.php?f=process">
      <div class="mb-3">
         <input type="text" class="form-control" name="name" id="name" placeholder="Név" aria-describedby="nameHelp" required/>
         <div id="nameHelp" class="form-text">Kötelezően kitöltendő!</div>
      </div>
      <div class="mb-3">
         <input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
         <div id="nameHelp" class="form-text">Kötelezően kitöltendő!</div>
      </div>
      <div class="mb-3">
      <textarea name="message" class="form-control" id="message" placeholder="Üzenet" rows="10" required></textarea>
      </div>


      <div class="g-recaptcha" data-sitekey="6Le8N8oUAAAAAGsHfGvzC-AZUTNvxb9SSD-d2fbl"></div>
      <div class="actions">
         <input type="submit" class="btn btn-primary" value="Beküld"/>
      </div>
   </form>
</div>
<script>
const constraints = {
   name: {
      presence: {allowEmpty: false}
   },
   email: {
      presence: {allowEmpty: false},
      email: true
   },
   message: {
      presence: {allowEmpty: false}
   }
};
const form = document.getElementById('contact-form');
form.addEventListener('submit', function (event) {
   const formValues = {
      name: form.elements.name.value,
      email: form.elements.email.value,
      message: form.elements.message.value
   };
   const errors = validate(formValues, constraints);
   if (errors) {
      event.preventDefault();
      const errorMessage = Object
      .values(errors)
      .map(function (fieldValues) {
         return fieldValues.join(', ')
      })
      .join("\n");
      alert(errorMessage);
   }
}, false);
</script>
