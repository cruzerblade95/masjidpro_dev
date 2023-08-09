<script>
const headers = new Headers();
headers.append('Content-Type', 'application/json');

const body = `{"name":"matdus","contact":"0125859540","userStatus":"Low","tenant":"5fbc8428b7c5371e31c7793a","location":"VELOCITY CYBERHOUSE - Masjid Pro (Test)","createdDate":"2021-04-09T17:29:11.257Z","type":0}`;

const init = {
  method: 'POST',
  headers,
  body
};

fetch('https://mysejahtera.malaysia.gov.my/clockin', init)
.then((response) => {
  return response.json(); // or .text() or .blob() ...
})
.then((text) => {
  // text is the response body
})
.catch((e) => {
  alert('ada error');
});
</script>