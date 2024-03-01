const urlParams = new URLSearchParams(window.location.search);
const boldOrderId = urlParams.get("bold-order-id");
const boldTxStatus = urlParams.get("bold-tx-status");

const apiUrl = `https://payments.api.bold.co/v2/payment-voucher/${boldOrderId}`;
const apiKey = 'AV02AAoOWxcLKC8e8jQ5NvlNiKEdIqsIO6TfvVNsIv4';

const peticion = async () => {
    try {
        const resp = await fetch(apiUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `x-api-key ${apiKey}`
            }
        });
    
        if (!resp.ok) {
            throw new Error(`HTTP error! Status: ${resp.status}`);
        }
    
        const data = await resp.json();
        console.log('Respuesta exitosa:', data);
    } catch (error) {
        console.error('Error en la solicitud:', error.message);
    }
}

peticion();