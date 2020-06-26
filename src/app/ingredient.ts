import { Nutriernt } from './nutrient';

export class Ingredient {
   private id: number;
   private description: string;
    private amount: number;
    private unit: string;
    private nutrients: Nutriernt[];


    constructor(
        id: number, 
        description: string, 
        amount: number,
        unit: string, 
        nutrients: Nutriernt[] 
        ){
        this.id  =id;
        this.description = description;
        this.amount = amount;
        this.unit = unit;
        this.nutrients = nutrients;
    }


    getId():number{
        return this.id;
    }

    getDescription():string{
        return this.description;
    }
    getAmount():number{
        return this.amount;
    }

    getUnit():string{
        return this.unit;
    }

    getNutrients():Nutriernt[]{
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

    setNutrients(nutrients: Nutriernt){
        this.nutrients.push(nutrients);
    }
}