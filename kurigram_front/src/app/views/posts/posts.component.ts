import { Component } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Post } from 'src/app/models/post'; 

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css']
})
export class PostsComponent {
  posts: Post[] = [];

  constructor(private requestService: RequestService) {}

  ngOnInit(): void {
    this.requestService.getPosts().subscribe((posts: Post[]) => {
      this.posts = posts;
    });
  }
}
