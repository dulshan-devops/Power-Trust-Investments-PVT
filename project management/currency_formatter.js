// Create our number formatter.
const formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'LKR',
});

console.log(formatter.format(monthlyPaybleAmt));
console.log(formatter.format(penaltyAmt));
console.log(formatter.format(totalPayble));