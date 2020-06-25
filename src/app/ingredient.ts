export class Ingredient {
   private id: number;
   private description: string;
    private amount: number;
    private unit: string;
    private nutrients: string[];


    constructor(
        id: number, 
        description: string, 
        amount: number,
        unit: string, 
        nutrients: string[] 
        ){
        this.id  =id;
        this.description = description;
        this.amount = amount;
        this.unit = unit;
        this.nutrients = nutrients;
    }


    getId(){
        return this.id;
    }

    getDescription(){
        return this.description;
    }
    getAmount(){
        return this.amount;
    }

    getUnit(){
        return this.unit;
    }

    getNutrients(){
        return this.nutrients;
    }

    setId(id: number){
        this.id = id;
    }

    setDescription(description: string){
        this.description = description;
    }

    setAmount(amount: number){
        this.amount = amount;
    }

    setUnit(unit :string){
        this.unit = unit;
    }

    setNutrients(nutrients: string[]){
        this.nutrients = nutrients;
    }
}