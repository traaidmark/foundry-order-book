<script>
  const orderForm = () => {

    const endpoint = '<?php echo $data["endpoint"]; ?>';
    console.log('forsdfsdfm', endpoint);
  
    const initForm = {
      nonce: undefined,
      customer: {},
      services: [],
    };

    return {
      form: {
        nonce: undefined,
        customer: {},
        services: [],
      },
      isLoading: false,
      response: null,
      submit: function(endpoint) {
      
        console.log('forsdfsdfm', endpoint);
        console.log('forsdfsdfm', JSON.stringify(this.form));

        this.isLoading = true;
        
        fetch(endpoint,{
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(this.form),
        })
          .then((res) => {
            this.isLoading = false;
            this.response = {
              type: 'a-message--success',
              message: 'Your submission has been submitted. Check your email for a confirmation.'
            };
            console.log('res happened',res);
          })
          .catch((err) => {
            this.isLoading = false;
            this.response = {
              type: 'a-message--error',
              message: 'Something went wrong. Please contact us for assistance.'
            };
            console.log('err happened', err.message)
          })
      }
    }
  };
</script>

<?php 

require_once _FNDRY_OB_PATH_ . 'common/foundry-render-template.php';

$template_path = _FNDRY_OB_PATH_ . 'templates/ob-form-field.php';

function render_fields($field_set, $scope) {
  foreach ($field_set as $field) {
    $field['scope'] = $scope;
    echo foundry_render_template(
      _FNDRY_OB_PATH_ . 'templates/ob-form-field.php',
      $field
    );
  }
}

?>

<form 
  class="fndry-form"
  x-data="orderForm()" 
  x-on:submit.prevent="submit('<?php echo $data['endpoint']; ?>')" 
>
  <aside x-show="response" class="a-message" :class="response?.type">
    <p x-text="response?.message"></p>
  </aside>

  <!-- <div x-show="!response"> -->
  <div>
    <div class="fndry-form__section">
    <?php
          render_fields($data['fields']['customer'], 'form.customer');
        ?>
    </div>
    <div class="fndry-form__section fndry-form__section--bordered">
    <template x-for="(item, index) in form.services" :key="index">';
      <div class="fndry-form__group">
        <?php
          render_fields($data['fields']['service'], 'form.services[index]');
        ?>
      <div>
      </template>
      <footer class="fndry-form-footer">
        <button type="button" @click="form.services.push({})" class="a-button a-button--secondary">Add Item</button>
      </footer>
    </div>
    <footer class="fndry-form__footer">
      <button type="submit" class="a-button" x-bind:disabled="isLoading">
        <span x-show="!isLoading"><?php echo $data['button_label'] ?></span>
        <span x-show="isLoading">Submitting...</span>
      </button>
      
    </footer>

  </div>
</form>

