import { Component,OnInit } from '@angular/core';
import { RequestService } from 'src/app/services/request.service';
import { Post } from 'src/app/models/post'; 

@Component({
  selector: 'app-posts',
  templateUrl: './posts.component.html',
  styleUrls: ['./posts.component.css']
})
export class PostsComponent implements OnInit {
  posts: Post[];

  constructor(private requestService: RequestService) {}

  ngOnInit() {
    this.requestService.getPosts().subscribe((posts) => {
      this.posts = posts;
    });
  }
}
