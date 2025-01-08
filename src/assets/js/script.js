const orderForm = () => {
  console.log('SOMETHING IS HAPPENING')
  const form = {
    nonce: undefined,
    customer: {},
    line_items: [],
  }

  const submit = (endpoint) => {
    
    console.log('forsdfsdfm', endpoint);
    console.log('forsdfsdfm', JSON.stringify(form));
    
    fetch(endpoint,{
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(form),
    })
      .then((res) => console.log('res happened',res))
      .catch((err) => console.log('err happened', err.message))
  }

  return {
    form,
    submit
  }
};

