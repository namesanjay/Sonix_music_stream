// function check(){
//     return ['Sanjay','Arbin','Sanjeev','Anish']
// }
// function print(array){
//     for(let i of array)
//         console.log(i)
// }
// let arr=['Sanjay','Arbin','Sanjeev','Anish','Sudeep']
// print(arr)
// let val=check()
// console.log(val)

// let a='10'
// a=Number.parseInt(a)
// console.log(typeof a)


let arr = [1, 1, 1, 2];
const allEqual =
    arr => arr.every(v => v === arr[0]);

console.log(allEqual(arr));
