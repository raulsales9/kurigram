export interface Post {
  _id: string;
  text: string;
  file: string;
  created_at: string;
  user: string;
  likes: number; // se agrega la propiedad likes
  isSubmitted: number;
  title: string;
}