/* Pivot */

export default () => ({
  autoCheck() {
    let fields = this.$root.querySelectorAll('.pivotField')

    fields.forEach(function (value, key) {
      value.addEventListener('change', event => {
        let tr = value.closest('tr')
        let checker = tr.querySelector('.pivotChecker')

        checker.checked = event.target.value
      })
    })
  },
})
