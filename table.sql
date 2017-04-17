/**
 * Created by PhpStorm.
 * User: my
 * Date: 2017-04-16
 * Time: 오후 11:41
 */

/**
 * view : 글번호,댓글, 카테고리, 글제목, 작성자, 뷰, 좋아요
 * option : 삭제여부, 비밀글여부
 */
CREATE TABLE newstory_category(
  idx VARCHAR(6) NOT NULL PRIMARY KEY COMMENT '카테고리 id',
  name VARCHAR(20) NULL UNIQUE KEY COMMENT '카테고리 이름',
  sub_cnt INT NOT NULL COMMENT '서브카테고리 갯수',
  path VARCHAR(30) NOT NULL DEFAULT '/' COMMENT '카테고리 경로'
) ENGINE = InnoDB DEFAULT CHARSET = UTF8 COMMENT = '카테고리 테이블';

CREATE TABLE newstory_list (
  idx INT not null PRIMARY KEY AUTO_INCREMENT comment '글번호 (code)',
  FK_category VARCHAR(6) NOT NULL comment '글 카테고리',
  subject VARCHAR(50) NOT NULL comment '글 제목',
  contents VARCHAR(255) NOT NULL comment '글 내용',
  writer INT NOT NULL comment '작성자 (code, foreign key)',
  views INT NOT NULL DEFAULT '0' comment '페이지 뷰',
  likes INT NOT NULL DEFAULT '0' comment '좋아요',
  regist DATETIME NOT NULL comment '작성일',
  in_use TINYINT NOT NULL DEFAULT '1' comment '사용여부 (0 삭제, 1 사용)',
  in_secret TINYINT NOT NULL DEFAULT '1' comment '비밀글 여부 (0 삭제, 1 사용)',
  FOREIGN KEY (`writer`) REFERENCES `users` (`idx`),
  FOREIGN KEY (`FK_category`) REFERENCES `newstory_category` (`idx`)
) ENGINE = InnoDB DEFAULT CHARSET = UTF8;

CREATE TABLE newstory_comment(
  idx INT NOT NULL PRIMARY KEY AUTO_INCREMENT comment '댓글번호 (code)',
  pid INT NOT NULL comment '글번호 (code, foreign key)',
  contents TEXT NOT NULL comment '댓글 내용',
  regist DATETIME NOT NULL comment '댓글 작성일',
  writer INT NOT NULL comment '댓글 작성자 (code,foreign key)',
  FOREIGN KEY (`writer`) REFERENCES `users` (`idx`),
  FOREIGN KEY (`pid`) REFERENCES `newstory_list` (`idx`)
) ENGINE = InnoDB DEFAULT CHARSET = UTF8 COMMENT = '블로그 뷰';

CREATE TABLE newstory_files (
  pid INT NOT NULL comment '글번호 (code, foreign key)',
  file_name VARCHAR(50) NOT NULL,
  file_type VARCHAR(10) NOT NULL,
  file_regist DATETIME NOT NULL,
  FOREIGN KEY (`pid`) REFERENCES `newstory_list` (`idx`)
)ENGINE = InnoDB DEFAULT CHARSET = UTF8 COMMENT = '블로그 파일';


/**
insert test data
 */
INSERT INTO newstory_category (idx, name, sub_cnt, path)
VALUES ('000000','HOME',0,'/');
INSERT INTO newstory_category (idx, name, sub_cnt, path)
VALUES ('100000','취미·유머',0,'/hobby');
INSERT INTO newstory_category (idx, name, sub_cnt, path)
VALUES ('200000','문화',0,'/culture');
INSERT INTO newstory_category (idx, name, sub_cnt, path)
VALUES ('300000','강의',0,'/lecture');
INSERT INTO newstory_category (idx, name, sub_cnt, path)
VALUES ('400000','IT',0,'/it');
INSERT INTO newstory_category (idx, name, sub_cnt, path)
VALUES ('500000','Design',0,'/design');
INSERT INTO newstory_category (idx, name, sub_cnt, path)
VALUES ('600000','여행·맛집',0,'/travel');


INSERT INTO newstory_list (FK_category,subject,contents,writer,views,likes,regist,in_use,in_secret)
VALUES ('200000','1번째 테스트 제목','첫번째 테스트 본문내용',1,3333,503,'now()',1,0);
INSERT INTO newstory_list (FK_category,subject,contents,writer,views,likes,regist,in_use,in_secret)
VALUES ('200000','2번째 테스트 제목','2번째 테스트 본문내용',1,3333,503,'now()',1,0);
INSERT INTO newstory_list (FK_category,subject,contents,writer,views,likes,regist,in_use,in_secret)
VALUES ('200000','3번째 테스트 제목','3번째 테스트 본문내용',1,3333,503,'now()',1,0);
INSERT INTO newstory_list (FK_category,subject,contents,writer,views,likes,regist,in_use,in_secret)
VALUES ('200000','4번째 테스트 제목','4번째 테스트 본문내용',1,3333,503,'now()',1,0);


INSERT INTO newstory_comment (pid,contents,regist,writer)
VALUES (1,'1번째 글의 1번째 댓글','now()',1);
INSERT INTO newstory_comment (pid,contents,regist,writer)
VALUES (2,'2번째 글의 1번째 댓글','now()',1);
INSERT INTO newstory_comment (pid,contents,regist,writer)
VALUES (1,'1번째 글의 2번째 댓글','now()',1);
INSERT INTO newstory_comment (pid,contents,regist,writer)
VALUES (1,'3번째 글의 3번째 댓글','now()',1);
