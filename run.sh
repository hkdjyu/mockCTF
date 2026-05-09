#!/bin/bash
set -e

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$SCRIPT_DIR"

show_menu() {
  echo
  echo "==============================="
  echo "  mockCTF Docker 控制選單"
  echo "==============================="
  echo "[1] 啟動 CTF (build + up)"
  echo "[2] 停止 CTF (down)"
  echo "[3] 重啟 CTF"
  echo "[4] 查看狀態 (ps)"
  echo "[5] 查看 logs"
  echo "[6] 停止並刪除映像檔 (down --rmi all)"
  echo "[7] 停止並刪除指定服務映像檔"
  echo "[8] 重啟指定服務"
  echo "[0] 離開"
  echo
  read -r -p "請輸入選項 (0-8): " choice

  case "$choice" in
    1) action="start" ;;
    2) action="stop" ;;
    3) action="restart" ;;
    4) action="status" ;;
    5) action="logs" ;;
    6) action="clean" ;;
    7) action="cleanone" ;;
    8) action="restartone" ;;
    0) action="exit" ;;
    *)
      echo "無效選項，請重試。"
      show_menu
      return
      ;;
  esac
}

action="${1:-}"
service="${2:-}"
interactive_mode=0

if [[ -z "$action" ]]; then
  interactive_mode=1
fi

run_action() {
  case "$action" in
    start)
      echo "[INFO] 啟動 CTF 容器..."
      docker compose up --build -d
      ;;
    stop)
      echo "[INFO] 停止 CTF 容器..."
      docker compose down
      ;;
    restart)
      echo "[INFO] 重啟 CTF 容器..."
      docker compose down
      docker compose up --build -d
      ;;
    status)
      echo "[INFO] 目前容器狀態:"
      docker compose ps
      ;;
    logs)
      if [[ -z "$service" ]]; then
        read -r -p "輸入服務名稱 (例如 web01，留空查看全部): " service
      fi
      if [[ -z "$service" ]]; then
        docker compose logs --tail=120
      else
        docker compose logs -f --tail=120 "$service"
      fi
      ;;
    clean)
      echo "[WARN] 將停止容器並刪除映像檔..."
      docker compose down --rmi all
      ;;
    cleanone)
      if [[ -z "$service" ]]; then
        read -r -p "輸入服務名稱 (例如 web27): " service
      fi
      if [[ -z "$service" ]]; then
        echo "[ERROR] 未提供服務名稱。"
        return 1
      fi

      container_id="$(docker compose ps -a -q "$service" | head -n 1)"
      image_id=""
      if [[ -n "$container_id" ]]; then
        image_id="$(docker inspect -f '{{.Image}}' "$container_id" 2>/dev/null || true)"
      fi

      echo "[INFO] 停止服務 $service ..."
      docker compose stop "$service"

      echo "[INFO] 刪除服務容器 $service ..."
      docker compose rm -f "$service"

      if [[ -n "$image_id" ]]; then
        echo "[INFO] 刪除映像檔 $image_id ..."
        docker image rm -f "$image_id"
      else
        echo "[WARN] 找不到服務 $service 對應的映像檔 ID，已跳過刪除映像檔。"
      fi
      ;;
    restartone)
      if [[ -z "$service" ]]; then
        read -r -p "輸入服務名稱 (例如 web27): " service
      fi
      if [[ -z "$service" ]]; then
        echo "[ERROR] 未提供服務名稱。"
        return 1
      fi
      echo "[INFO] 重啟服務 $service ..."
      docker compose restart "$service"
      ;;
    exit)
      exit 0
      ;;
    help|-h|--help)
      echo "用法:"
      echo "  ./run.sh start      啟動全部題目"
      echo "  ./run.sh stop       停止全部題目"
      echo "  ./run.sh restart    重啟全部題目"
      echo "  ./run.sh status     查看容器狀態"
      echo "  ./run.sh logs web01 查看指定服務 logs"
      echo "  ./run.sh clean      停止並刪除映像檔"
      echo "  ./run.sh cleanone web27 停止指定服務並刪除該服務映像檔"
      echo "  ./run.sh restartone web27 重啟指定服務"
      echo
      echo "不帶參數執行可進入互動選單。"
      ;;
    *)
      echo "未知指令: $action"
      echo "執行 ./run.sh help 查看用法"
      return 1
      ;;
  esac
}

if [[ "$interactive_mode" -eq 1 ]]; then
  while true; do
    action=""
    service=""
    show_menu
    if ! run_action; then
      echo "[ERROR] 操作失敗，請檢查服務名稱或 Docker 狀態後重試。"
    fi
    echo
    read -r -p "按 Enter 返回選單..." _
  done
else
  run_action
fi
