// Q1
let numbers = [2, 5, 12, 13, 15, 18, 22]
//ここに答えを実装してください。↓↓↓

// 偶数のみの配列を作成
const odd_num = numbers.filter((num) => num % 2 === 0) // @odd_num [2, 12, 18, 22]
function isEven(num) {
  console.log(num + 'は偶数です')
}
// 偶数のみの配列 @odd_numから値をひとつずつ取り出す

const num = odd_num.forEach((num) => isEven(num)) // @num 2, 12, 18, 22

// Q2
class Car {
  constructor(gass, num) {
    this.gass = gass
    this.num = num
  }
  getNumGas() {
    console.log(`ガソリンは${this.gass}です。ナンバーは${this.num}です`)
  }
}

const toyota_car = new Car('ハイオク', 8888)
toyota_car.getNumGas()
