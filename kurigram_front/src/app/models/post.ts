export interface Post {
  _id: string;
  text: string;
  image: string;
  created_at: Date;
  user: string;
  likes: number; // se agrega la propiedad likes
  isSubmitted: number;
  title: string;
  liked?: boolean;
}
