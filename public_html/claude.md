# Towaidee Forum Project Analysis

## プロジェクト概要
- **プロジェクト名**: Towaidee Forum
- **フォーラムソフトウェア**: Simple Machines Forum (SMF) バージョン 2.1.6
- **主要言語**: タイ語 (thai)
- **URL**: https://www.towaidee.com
- **最終更新**: 2025年

## 技術スタック

### サーバーサイド
- **PHP**: SMF 2.1.6
- **データベース**: MySQL
  - データベース名: `admin_towaidee_db`
  - テーブルプレフィックス: `smf_`
  - 文字セット: UTF-8
- **サーバー**: Linux (Azure)

### フロントエンド
- **jQuery**: 3.6.3
- **テーマ**: 
  - Default SMF テーマ
  - Elementary テーマ
  - LIkeIPB テーマ (カスタムテーマ)
- **CSS フレームワーク**: Bootstrap (LIkeIPB テーマ内)

## プロジェクト構造

### 主要ディレクトリ
```
/workspaces/towaidee/public_html/
├── index.php                 # メインエントリーポイント
├── Settings.php              # 設定ファイル
├── SSI.php                   # Server Side Includes API
├── Sources/                  # PHPソースコード
├── Themes/                   # テーマファイル
├── Packages/                 # インストールパッケージ
├── Smileys/                  # 絵文字リソース
├── attachments/              # ファイル添付
├── avatars/                  # アバター画像
├── cache/                    # キャッシュファイル
└── custom_avatar/            # カスタムアバター
```

### 主要機能モジュール (Sources/)
- **Admin.php**: 管理機能
- **BoardIndex.php**: フォーラムトップページ
- **Display.php**: トピック表示
- **MessageIndex.php**: メッセージ一覧
- **Post.php**: 投稿機能
- **Profile.php**: ユーザープロフィール
- **Search.php**: 検索機能
- **ManageBoards.php**: ボード管理
- **ManageMembers.php**: メンバー管理

## インストール済みモジュール/拡張機能

### SEO関連
- **SEO Pro Mod**: SEO最適化モジュール
- **Pretty URLs**: URL最適化
- **Sitemap生成**: XML サイトマップ自動生成

### UI/UX拡張
- **HideMessageIcons**: メッセージアイコン非表示機能
- **Likes機能**: いいね機能
- **Mentions**: メンション機能

### その他
- **ReCaptcha**: スパム対策
- **Draft機能**: 下書き保存
- **Unicode対応**: 多言語サポート

## テーマ情報

### 1. Default Theme
- SMF標準テーマ
- レスポンシブデザイン対応
- 多言語対応 (タイ語含む)

### 2. Elementary Theme
- シンプルなデザインテーマ
- 複数カラーバリエーション (緑、赤)

### 3. LIkeIPB Theme
- IPB風デザインテーマ
- Bootstrap対応
- ダークモード対応
- カルーセル機能
- カスタムカラー対応

## データベース設定
- **Type**: MySQL
- **Host**: localhost
- **Database**: admin_towaidee_db
- **User**: da_admin
- **Prefix**: smf_
- **Charset**: utf8

## セキュリティ設定
- メンテナンスモード対応
- エラーレポート機能
- セッション管理
- CSRF保護
- SQL インジェクション対策

## 開発環境情報
- **作業ディレクトリ**: /workspaces/towaidee/public_html
- **Git**: 初期化済み (mainブランチ)
- **プラットフォーム**: Linux Azure
- **PHP バージョン**: SMF 2.1.6 対応版

## 注意事項
- タイ語フォーラムとして運用
- 本番環境URL: https://www.towaidee.com
- データベースパスワードなどの機密情報は Settings.php に格納
- キャッシュシステム (SQLite3) 使用
- ファイルアップロード機能有効

## メンテナンス
- バックアップ機能あり (Packages/backups/)
- 定期タスク機能 (cron.php)
- ログ管理機能
- エラー追跡機能