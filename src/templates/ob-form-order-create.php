<script>
  console.log('ORDER-BOOK')
  const orderForm = () => {
    console.log('ORDER-BOOK: SUBMIT')

    const endpoint = 'http://localhost/v1/lol-test';

    const form = {
      nonce: undefined,
      customer: {},
      services: [],
    }

    const isLoading = false;

    const submit = () => {

      const endpoint = 'http://localhost/v1/lol-test';

      console.log('ORDER-BOOK > ENDPOINT: ', endpoint);
      console.log('ORDER-BOOK > DATA', JSON.stringify(form));
      
      // fetch(endpoint,{
      //   method: 'POST',
      //   headers: { 'Content-Type': 'application/json' },
      //   body: JSON.stringify(form),
      // })
      //   .then((res) => console.log('res happened',res))
      //   .catch((err) => console.log('err happened', err.message))
    }

    return {
      form,
      isLoading,
      submit
    }
  };

</script>

<form 
  class="botanist-form"
  x-data="orderForm()" 
  x-on:submit.prevent="submit"
>
  <div class="botanist-form__section">
    <?php 
      foreach ($data['customer-fields'] as $field) {
        echo $field;
      }
    ?>
  </div>
  <div class="botanist-form__section">
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
    <button type="submit" class="a-button">
      <?php echo $data['button_label'] ?>
    </button>
  </footer>
  <div x-text="form.customer">
    
  </div>
</form>

