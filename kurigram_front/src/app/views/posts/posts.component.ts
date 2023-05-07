import { Component, OnInit, Input } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Post } from 'src/app/models/post';
import { OwlOptions } from 'ngx-owl-carousel-o';

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css'],
})
export class PostsComponent implements OnInit {
  @Input() post: Post;
  posts: Post[];
  currentUserId: number;

  constructor(private requestService: RequestService) {}

  public likes: number = 0;
  ngOnInit() {
    // Obtener el ID del usuario actual. Este es solo un ejemplo y debes reemplazar esto con tu propia lógica para obtener el ID del usuario actual.
    this.currentUserId = 1;
  
    this.requestService.getPosts().subscribe((posts) => {
      // Verificar si el usuario actual ya ha dado "me gusta" a cada publicación.
      posts.forEach(post => {
        const key = `liked_${post._id}_${this.currentUserId}`;
        post.likes = Number(localStorage.getItem(`likes_${post._id}`)) || 0;
        post.liked = localStorage.getItem(key) === 'true';
      });
  
      this.posts = posts;
    });
  }
  onLike(post: Post) {
    const key = `liked_${post._id}_${this.currentUserId}`;
    const hasLiked = localStorage.getItem(key) === 'true';
  
    if (hasLiked) {
      post.likes--;
      post.liked = false;
      localStorage.setItem(key, 'false');
    } else {
      post.likes++;
      post.liked = true;
      localStorage.setItem(key, 'true');
    }
  
    localStorage.setItem(`likes_${post._id}`, String(post.likes));
  }
}
