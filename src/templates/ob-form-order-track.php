<script>
  console.log('ORDER-TRACK')
  const trackForm = () => {

    const initFormState = {
      code: '',
      res: [],
    };

    const form = {
      code: '',
      res: [],
    }

    let isLoading = false;
    let isSubmitted = false;

    const submit = (endpoint) => {

      isLoading = true;

      console.log('ORDER-TRACK > ENDPOINT: ', endpoint);
      console.log('ORDER-TRACK > DATA', form.code);

      // fetch(endpoint,{
      //   method: 'POST',
      //   headers: { 'Content-Type': 'application/json' },
      //   body: JSON.stringify(form),
      // })
      //   .then((res) => {
      //     isLoading = false;
      //     isSubmitted = true;
      //     console.log('res happened',res)
      //   })
      //   .catch((err) => console.log('err happened', err.message))
    }

    return {
      form,
      isLoading,
      isSubmitted,
      submit
    }
  };

</script>

<form 
  class="botanist-form"
  x-data="trackForm()" 
  x-on:submit.prevent="submit('<?php echo $data['endpoint']; ?>')"
>
    <!-- <aside x-show="isLoading">
    <p>Submission has been submitted successfully.</p>
  </aside> -->

  <div class="botanist-form__section">

    <div class="a-field">

      <label for="foundry-ob-tracking-code">
        Order tracking code
      </label>

      <input 
        type="text"
        name="tracking-code" 
        id="foundry-ob-tracking-code" 
        x-model="<?php echo $field_scope; ?>"
      />
    </div>
  </div>
  <footer class="botanist-form__footer">
    <button type="submit" class="a-button">
      <?php echo $data['button_label'] ?>
    </button>
  </footer>
</form>

