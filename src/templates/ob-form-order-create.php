<script>
  console.log('ORDER-BOOK')
  const orderForm = () => {
    console.log('ORDER-BOOK: SUBMIT')

    const initFormState = {
      customer: {},
      services: [],
    };

    const form = {
      customer: {},
      services: [],
    }

    let isLoading = false;
    let isSubmitted = false;

    const submit = (endpoint) => {

      isLoading = true;

      console.log('ORDER-BOOK > ENDPOINT: ', endpoint);
      console.log('ORDER-BOOK > DATA', JSON.stringify(form));

      fetch(endpoint,{
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(form),
      })
        .then((res) => {
          isLoading = false;
          isSubmitted = true;
          console.log('res happened',res)
        })
        .catch((err) => console.log('err happened', err.message))
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
  x-data="orderForm()" 
  x-on:submit.prevent="submit('<?php echo $data['endpoint']; ?>')"
>
  
  <aside x-show="isLoading">
    <p>Submission has been submitted successfully.</p>
  </aside>
  <div class="botanist-form__section">
    <?php 
      foreach ($data['customer-fields'] as $field) {
        echo $field;
      }
    ?>
  </div>
  <div class="botanist-form__section botanist-form__section--bordered">
   <template x-for="(item, index) in form.services" :key="index">';
    <div class="botanist-form__group">
      <?php 
        foreach ($data['service-fields'] as $field) {
          echo $field;
        }
      ?>
    <div>
    </template>
    <footer class="botanist-form-footer">
      <button type="button" @click="form.services.push({})" class="a-button a-button--secondary">Add Item</button>
    </footer>
  </div>
  <footer class="botanist-form__footer">
    <button type="submit" class="a-button" bind:disabled="isLoading">
      <span x-show="!isLoading"><?php echo $data['button_label'] ?></span>
      <span x-show="isLoading">Submitting...</span>
    </button>
  </footer>
</form>

