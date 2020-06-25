import { Ingredient } from './ingredient';

export class Recipe {
  id: number;
  title: string;
  picture: File;
  servings: number;
  description: string;
  instruction: string;
  createionDate: Date;
  duration: number;
  difficulty: string;
  certified: boolean;
  lastChangeDate: Date;
  userId: number;
  keywords: string[];
  ratings: number;
  ingredients: Ingredient[];

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
    this.ratings = recipe.ratings;
    this.ingredients = recipe.ingredients;
  }

  getId() {
    return this.id;
  }

  getTitle() {
    return this.title;
  }

  getPicture() {
    return this.picture;
  }

  getServings() {
    return this.servings;
  }

  getDescription() {
    return this.description;
  }

  getInstruction() {
    return this.instruction;
  }

  getCreateionDate() {
    return this.createionDate;
  }

  getDuration() {
    return this.duration;
  }

  getDifficulty() {
    return this.difficulty;
  }

  getCertified() {
    return this.certified;
  }

  getLastChangeDate() {
    return this.lastChangeDate;
  }

  getUserId() {
    return this.userId;
  }

  getKeywords() {
    return this.keywords;
  }

  getRatings() {
    return this.ratings;
  }

  getIngredients() {
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

  setCertified(certified: boolean) {
     this.certified = certified;
  }

  setLastChangeDate(lastChangeDate: Date) {
     this.lastChangeDate = lastChangeDate;
  }

  setUserId(userId: number) {
     this.userId = userId;
  }

  setKeywords(keywords: string[]) {
     this.keywords = keywords;
  }

  setRatings(ratings: number) {
     this.ratings = ratings;
  }

  setIngredients( ingredients: Ingredient[]) {
    this.ingredients = ingredients;
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
    this.ratings = null;
    this.ingredients = null;
  }
}
