<script>
  const orderTrack = () => {

    const endpoint = '<?php echo $data["endpoint"]; ?>';

    return {
      order: undefined,
      isLoading: false,
      response: null,
      code: undefined,
      submit: async function(endpoint) {

        if(!this.code) {
          return;
        }

        this.isLoading = true;

        try {

          this.isLoading = false;

          const request = await fetch(`${endpoint}/${this.code}`);
          const res = await request.json();

          console.log('res', res);

          if(!res.data || res.data?.length === 0) {
            this.response = {
              type: 'a-message--error',
              message: 'There is no order with this code. Please try again, or contact us for assistance.'
            };
            return;
          }

          return this.order = res.data;

        } catch(err) {
          this.isLoading = false;
          this.response = {
            type: 'a-message--error',
            message: 'Something went wrong. Please contact us for assistance.'
          };
          console.log('err happened', err.message)
        }
      }
    }
  };
</script>

<form 
  class="fndry-form"
  x-data="orderTrack()" 
  x-on:submit.prevent="submit('<?php echo $data['endpoint']; ?>')" 
>
  <aside x-show="response" class="a-message" :class="response?.type">
    <p x-text="response?.message"></p>
  </aside>

  <!-- <div x-show="!response"> -->
  <div>
    <div class="fndry-form__section">
      <div class="a-field">

        <label for="foundry-ob-tracking-code">
          Order tracking code
        </label>

        <input 
          type="text"
          name="tracking-code" 
          id="foundry-ob-tracking-code" 
          x-model="code"
        />
      </div>
    </div>
    <footer class="fndry-form__footer">
      <button type="submit" class="a-button" x-bind:disabled="isLoading">
        <span x-show="!isLoading"><?php echo $data['button_label'] ?></span>
        <span x-show="isLoading">Searching...</span>
      </button>
      
    </footer>
  </div>
  <div class="fndry-results" x-show="!!order">
    <h2 x-text="order?.code"></h2>
    <h4 x-text="order?.status"></h4>
    <h5>Order Information</h5>

    <template x-for="item in order?.items">
      <ul>
        <template x-for="i in item">
            <li :class="{ 'grid': i.is_media }">
              <strong x-text="i.label"></strong>
              <span x-text="i.value" x-show="!i.is_media"></span>
              <div x-show="i.is_media">
                <template x-for="img in i.value">
                  <img :src="img" />
                </template>
              </div>
            </li>
        </template>
      </ul>
    </template>

    
  </div>
</form>
