export default function useCurrency() {

    const currencyFormat = (amount) => {
        // Create our number formatter.
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP',        
        });
        
        return formatter.format(amount); /* $2,500.00 */
    }

    return {
        currencyFormat,
    }


}