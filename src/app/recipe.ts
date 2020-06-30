import { Ingredient } from './ingredient';
import { Ratings } from './ratings';


export class Recipe {
  private id: number;
  private title: string;
  private picture: File;
  private servings: number;
  private description: string;
  private instruction: string;
  private createionDate: Date;
  private duration: number;
  private difficulty: string;
  private certified: boolean;
  private lastChangeDate: Date;
  private userId: number;
  private keywords: string[];
  private rating: Float32Array;
  private ratings: Ratings[];
  private ingredients: Ingredient[];

  constructor(recipe: Recipe) {
    this.id = recipe.id;
    this.title = recipe.title;
    this.picture = recipe.picture;
    this.servings = recipe.servings;
    this.description = recipe.description;
    this.instruction = recipe.instruction;
    this.createionDate = recipe.createionDate;
    this.duration = recipe.duration;
    this.difficulty = recipe.difficulty;
    this.certified = recipe.certified;
    this.lastChangeDate = recipe.lastChangeDate;
    this.userId = recipe.userId;
    this.keywords = recipe.keywords;
    this.rating = recipe.rating;
    this.ratings = recipe.ratings;
    this.ingredients = recipe.ingredients;
  }

  getId(): number {
    return this.id;
  }

  getTitle(): string {
    return this.title;
  }

  getPicture(): File {
    return this.picture;
  }

  getServings(): number {
    return this.servings;
  }

  getDescription(): string {
    return this.description;
  }

  getInstruction(): string {
    return this.instruction;
  }

  getCreateionDate(): Date {
    return this.createionDate;
  }

  getDuration(): number {
    return this.duration;
  }

  getDifficulty(): string {
    return this.difficulty;
  }

  getCertified(): number {
    if (this.certified == true){
      return 1;
    }else{
      return 0;
    }
  }

  getLastChangeDate(): Date {
    return this.lastChangeDate;
  }

  getUserId(): number {
    return this.userId;
  }

  getKeywords(): string[] {
    return this.keywords;
  }

  getRating(): Float32Array{
    return this.rating;
  }

  getRatings(): Ratings[] {
    return this.ratings;
  }

  getIngredients(): Ingredient[] {
    return this.ingredients;
  }

  setId( id: number) {
     this.id = id;
  }

  setTitle(title: string) {
    this.title = title;
  }

  setPicture(picture: File) {
     this.picture = picture;
  }

  setServings(servings: number) {
   this.servings = servings;
  }

  setDescription(description: string) {
    this.description = description;
  }

  setInstruction(instruction: string) {
    this.instruction = instruction;
  }

  setCreateionDate(createionDate: Date) {
    this.createionDate = createionDate;
  }

  setDuration(duration: number) {
    this.duration = duration;
  }

  setDifficulty(difficulty: string) {
    this.difficulty = difficulty;
  }

  setCertified(certified: number) {
    if(certified == 1){
      this.certified = true;
    }else{
      this.certified = false;
    }
  }

  setLastChangeDate(lastChangeDate: Date) {
     this.lastChangeDate = lastChangeDate;
  }

  setUserId(userId: number) {
     this.userId = userId;
  }

  setKeywords(keywords: string) {
     this.keywords.push(keywords);
  }

  setRatings(ratings: Ratings[]) {
    ratings.forEach((value) => {
      this.ratings.push(value);
    });
  }

  setIngredients( ingredients: Ingredient[]) {
    ingredients.forEach((value) => {
      this.ingredients.push(value);
    })
  }

  cleanRecipe() {
    this.id = null;
    this.title = '';
    this.picture = null;
    this.servings = null;
    this.description = '';
    this.instruction = '';
    this.createionDate = null;
    this.duration = null;
    this.difficulty = '';
    this.certified = null;
    this.lastChangeDate = null;
    this.userId = null;
    this.keywords = null;
    this.rating = null;
    this.ratings = null;
    this.ingredients = null;
  }
}
