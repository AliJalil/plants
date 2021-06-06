function genpdf(){
const el = document.getElementById('print')
const opt = {
  margin:       0.1,
  filename:     'planetCard.pdf',
  image:        { type: 'jpeg', quality: 0.98 },
  html2canvas:  { scale: 2 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
};
html2pdf().set(opt).from(el).save()

}